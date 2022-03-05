// Задание 1: Напишите скрипт, который будет вытаскивать первое предложение
// последней (по дате) новости на www.karoteka.ru
fetch('https://www.kartoteka.ru/')
    .then((response) => response.arrayBuffer())
    .then((buffer) => {
        let html = new TextDecoder('windows-1251').decode(buffer);
        let doc = new DOMParser().parseFromString(html, 'text/html');
        let b = doc.querySelectorAll(".news_item .image_block_no_image p")[0].innerHTML;
        let result = b.split(/\. /)[0].trim();

        console.log(result);
    })
    .catch(()=>console.log('Error'));



// Задание 2: Напишите код, который исполнив в консоли, получим в подвале www.karoteka.ru
// (рядом с телефоном) текущее время (обновляемое по секундам)
let div = document.createElement('div');
div.className = 'tr-time';
document.querySelector('.phone_ks.phone-bg__tel--default').append(div);
setInterval(()=>{
    let date = new Date();
    document.querySelector('.tr-time').innerHTML
        = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
}, 1000);
