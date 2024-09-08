const url = 'https://google-search72.p.rapidapi.com/imagesearch?q=Melbourne%20city&gl=au&lr=lang_en&num=20&start=0';
const options = {
    method: 'GET',
    headers: {
        'X-RapidAPI-Key': 'feb0bdba32mshbc4a1b0b9abc693p1921cejsn340df46a1a10',
        'X-RapidAPI-Host': 'google-search72.p.rapidapi.com'
    }
};

try {
    fetch(url, options)
        .then(function (response) { return response.json() })
        .then(function (jsonData) {
            var randomIndex = Math.floor(Math.random() * jsonData.items.length);
            var imgfetchurl = jsonData.items[randomIndex].originalImageUrl;
            let img = document.getElementById("demofac");
            img.src = imgfetchurl;
        });
} catch (error) {
    console.error(error);
}
