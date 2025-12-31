var backButton = document.querySelector('.back');

if (backButton) {
    backButton.addEventListener('click', ()=>{
        back();
    });
}

function back() {
    window.location.href = '../index.html';
}

function displayArticles(articles) {
    const container = document.querySelector('.table-content');
    container.innerHTML = '';
    
    articles.forEach((article) => {
        const articleRow = document.createElement('div');
        articleRow.className = 'row';
        var articleTitle = document.createElement('div');
        articleTitle.className = 'row-item title';
        articleTitle.innerHTML = `
            <h3>${article.title}</h3>
        `;
        var articleDate = document.createElement('div');
        articleDate.className = 'row-item date';
        articleDate.innerHTML = `
            <p>${article.date}</p>
        `;
        var articleSummary = document.createElement('div');
        articleSummary.className = 'row-item summary';
        articleSummary.innerHTML = `
            <p>${article.summary}</p>
        `;
        
        articleRow.appendChild(articleTitle);
        articleRow.appendChild(articleDate);
        articleRow.appendChild(articleSummary);

        container.appendChild(articleRow);
    });
}

function loadCachedData() {
    fetch('readData.php')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.articles.length > 0) {
                displayArticles(data.articles);
            }
        })
}

function clearDataFile() {
    return fetch('saveData.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ clear: true }),
    })
    .then(response => response.text())
    .then(result => {
        console.log('Data file cleared:', result);
    })
}

function fetchHowManyPages(url) {
    return fetch('getData_alternative.php?url=' + encodeURIComponent(url))
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            
            const parser = new DOMParser();
            const html = parser.parseFromString(data, 'text/html');
            const parserError = html.querySelector('parsererror');
            if (parserError) {
                console.error('Parser error:', parserError.textContent);
            }

            var paginationElement = html.querySelectorAll('.pagination a');
            
            var lastPage = 0;

            paginationElement.forEach((element) => {
                var pageNumber = parseInt(element.textContent.trim());
                if (!isNaN(pageNumber) && pageNumber > lastPage) {
                    lastPage = pageNumber;
                }
            });
            
            console.log('Last page detected:', lastPage);
            return lastPage > 0 ? lastPage : 1;
        })
        .catch(error => {
            console.error('Error in fetchHowManyPages:', error);
            return 1;
        });
}

function writeDataToFile(data) {
    return fetch('saveData.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ data: data }),
    })
    .then(response => response.text())
    .then(result => {
        console.log('Data saved successfully:', result);
        return result;
    })
    .catch(error => {
        console.error('Error saving data:', error);
        throw error;
    });
}

function fetchSGGWEventsData(url, lastPage) {
    console.log('Fetching data for', lastPage, 'pages.');

    clearDataFile().then(() => {
        const fetchPromises = [];
        
        for (let page = 1; page <= lastPage; page++) {
            let pagedUrl = url + '/page/' + page + '/';
            
            const pagePromise = fetch('getData_alternative.php?url=' + encodeURIComponent(pagedUrl))
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const html = parser.parseFromString(data, 'text/html');

                    var articles = html.querySelectorAll('.entry-content');
                    const savePromises = [];

                    articles.forEach((article) => {
                        var titleElement = article.querySelector('.entry-title');
                        var dateElement = article.querySelector('.mn-entry-date');
                        var summaryElement = article.querySelector('.mn-mod-text-links');

                        var title = titleElement ? titleElement.textContent.trim() : 'Brak tytułu';
                        var date = dateElement ? dateElement.textContent.trim() : 'Brak daty';
                        var summary = summaryElement ? summaryElement.textContent.trim() : 'Brak streszczenia';
                        
                        summary = summary.replace(/Czytaj dalej\.?$/i, '').trim();

                        let crawledData = {
                            title: title,
                            date: date,
                            summary: summary
                        };

                        savePromises.push(writeDataToFile(crawledData));
                    });
                    
                    return Promise.all(savePromises).then(() => {
                        console.log(`Completed page ${page}/${lastPage}`);
                    });
                })
            
            fetchPromises.push(pagePromise);
        }
        
        Promise.all(fetchPromises).then(() => {
            setTimeout(() => loadCachedData(), 500);
        });
    });
    console.log('Data fetching initiated for all pages.');
}

url = 'https://www.sggw.edu.pl/category/aktualnosci';
window.onload = () => {
    loadCachedData();
    fetchHowManyPages(url).then(lastPage => fetchSGGWEventsData(url, lastPage));
};