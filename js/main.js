// пробуем-с

class Product {
    constructor(productPic, productName, productPrice, productLink) {
        this.pic = productPic;
        this.name = productName;
        this.price = productPrice;
        //    this.link = ;
        this.el = document.querySelector('.catalog');
        this.pagBlock = document.querySelector('.pages');
    }

    renderCatalogItem () {

        let item = document.createElement('div');
        item.classList.add('catalog-item');

        item.innerHTML = `
        <div class="catalog-item-pic" style="background: url(../images/${this.pic}) no-repeat center center / contain"></div>
        <div class="catalog-item-name">${this.name}</div>
        <div class="catalog-item-price"> ${this.price} руб.</div> 
        `;

        this.el.appendChild(item);

    };

    clearCatalog() {
        this.el.innerHTML = '';

    };

    preloaderOn() {
        this.el.innerHTML = `<div class="preloader"> </div>`;
    };

    preloaderOff() {
        this.clearCatalog();
    };

    renderPagination( allBlocks, curentPage) {
        // ПАГИНАЦИЯ
        // кубики страниц
        // 1. номер активного кубика

        // 2. общее кол-во кубиков

        

        for ( let i = 1; i <= allBlocks; i++ ) {
            
            let item = document.createElement('div');
            item.classList.add('pageNum');

            if ( i == curentPage ) {
                item.classList.add('_active');
            }

            item.addEventListener( 'click', () =>  {

                // 1. Узнаем значение селекта
                let allSelectsAndValues = document.querySelectorAll('select');
                // ?category=1&size=M&price=1000-3000
                let catValue = `?category=${allSelectsAndValues[0].value}&size=${allSelectsAndValues[1].value}&price=${allSelectsAndValues[2].value}`;

                this.renderCatalog(catValue, i);
            });

            item.innerHTML = i; 
            this.pagBlock.appendChild(item);
        }
    }

    renderCatalog(category, curentPage = 1) {

        
        
        let cat = (category !== '') ? category : '?category=1';
        // то же самое:
        // let cat = '?category=1';
        // if (category !== '') {
        //     cat = category;
        // }

        curentPage = `&curPage=${curentPage}`;

        // создаем запрос отправляем
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `../handlers/catalogHandler.php${cat}${curentPage}`);
        xhr.send();

        // очистим каталог

        this.clearCatalog();
        this.preloaderOn();

        // добавим прелоадер

 
        // console.dir(xhr);

        // проверяем, пришли ли данные с сервера
        xhr.addEventListener('load', () => {

            this.preloaderOff();

            let data = JSON.parse(xhr.responseText);

            console.log(data);
            // data.pagination.curentPage

            data.catalogItems.forEach( (value, index) => {

                let catalogItem = new Product(value.image, value.name, value.price, 'link');
                catalogItem.renderCatalogItem();
               
            });

            this.renderPagination(data.pagination.allPages, data.pagination.curentPage );
        });

    }

};

let cat = window.location.search;
// console.log(cat);

let newCatalog = new Product();
newCatalog.renderCatalog(cat);

// формирование каталога по категориям в select

let catSelect = document.querySelector('.filter');
catSelect.addEventListener('change', function() {
    // узнаем значение select
    let catValue = `?category=${catSelect.value}`;
    console.log(catValue);
    // рендерим каталог заново
    newCatalog.renderCatalog( catValue );

})

// let catSelect = document.querySelector('option');

// catSelect.forEach( function( value, index) {

//     value.addEventListener('change', function() {
//         // 1. Узнаем значение селекта
//         let allSelectsAndValues = document.querySelectorAll('option');
//         // ?category=1&size=M&price=1000-3000
//         let catValue = `?category=${allSelectsAndValues[0].value}&size=${allSelectsAndValues[1].value}&price=${allSelectsAndValues[2].value}
//         `;
//         // 2. Рендерим каталог заново
//         newCatalog.renderCatalog( catValue );
//     })

// })



