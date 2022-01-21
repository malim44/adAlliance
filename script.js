const timestamp = new Date(),
    hour = timestamp.getHours(),
    posElement = document.querySelector('#position'),
    fetchElement = document.querySelector('#fetchAd');

if(fetchElement) {
    fetchElement.addEventListener('click', () => {
        if(posElement) {
            let position = posElement.value,
                url = `advertising.php?pos=${position}&hour=${hour}`;

            (async () => {
                let response = await fetch(url);

                if(response.ok) {
                    response
                        .text()
                        .then(result => {
                            let adElement = document.querySelector('#advertising');
                            if(result) {
                                const resultObj = JSON.parse(result);

                                Object.assign(adElement.style, {
                                    width: resultObj.width + 'px',
                                    height: resultObj.height + 'px',
                                    backgroundImage: 'url(' + resultObj.image + ')',
                                    cursor: 'pointer'
                                });

                                adElement.addEventListener('click', () => {
                                    window.open(resultObj['link'], '_blank');
                                })
                                adElement.innerHTML = '';   // removing text "Leider keine Werbung ...", if ad is shown
                            } else {
                                adElement.style.cssText = `
                                    width: 160px;
                                    backgroundImage = none;
                                    cursor = default;
                                `;
                                adElement.innerHTML = 'Leider keine Werbung für diesen Zeitraum';
                                adElement.replaceWith(adElement.cloneNode(true));   // removing event-listener, if no ad is shown
                            }
                        });
                } else {
                    console.log('HTTP-Error: ' + response.status);
                }

            })()

        }
    });
}