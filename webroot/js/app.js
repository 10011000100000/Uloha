window.addEventListener('load', () => {
    let addToCartButtons = document.getElementsByClassName('addToCart');

    for (let i = 0; i < addToCartButtons.length; i++) {
        addToCartButtons[i].addEventListener('click', (event) => {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '/pages/addtocart/'+event.target.getAttribute('data-id'), true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-Token', document.querySelector('meta[name="csrfToken"]').content);
            xhr.send();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
                    let cartSummary = document.querySelectorAll('#cart>div>span');
                    cartSummary[0].innerText = response.subtotal+'€';
                    cartSummary[1].innerText = (response.total - response.subtotal).toFixed(2)+'€';
                    cartSummary[2].innerText = response.total+'€';
                }
            };
        });
    }
})






