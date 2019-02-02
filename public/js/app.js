let httpHelper = (function () {

  function get(uri, success, fail) {

    $.ajax({
      url: `/api/${uri}`,
      method: "get",
      dataType: "json",
      success: success,
      fail: fail
    });
  }

  return {
    get: get
  }
})();

let allProducts = (function () {
  let state = {
    products: [{
        id: 1,
        img: "/images/item1.jpg",
        alt: "IMG-PRODUCT",
        name: "Herschel Supply co 251",
        price: 75.00,
        new: true
      },
      {
        id: 2,
        img: "/images/item2.jpg",
        alt: "IMG-PRODUCT",
        name: "Herschel Supply co 251",
        price: 75.00,
        name: "Denim jacket blue"
      },
      {
        id: 3,
        img: "/images/item3.jpg",
        alt: "IMG-PRODUCT",
        name: "Coach slim easton black",
        price: 75.00,
        sale: 15.60
      }
    ]
  };

  let rootNode;

  function setState(newState) {
    state = newState
    render();
  }

  function init() {
    rootNode = $("#products");
  }

  function render() {
    rootNode.html("");
    let html = "";
    state.products.forEach((product) => {
      html += template(product)
    });
    rootNode.html(html);
  }

  function price(product) {
    if(!product.sale) {
      return `<span class="block2-price m-text6 p-r-5">
										$${product.price}
									</span>`;
    }

    return `<span class="block2-oldprice m-text7 p-r-5">
              $${product.price}
            </span>

            <span class="block2-newprice m-text8 p-r-5">
              $${product.sale}
            </span>`
  }

  function template(product) {
    return `
      <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative ${product.new ?  'block2-labelnew':''}">
									<img src="${product.img}" alt="${product.alt}">

									<div class="block2-overlay trans-0-4">
										<a data-id="${product.id}" href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button data-id="${product.id}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="/product/${product.id}" class="block2-name dis-block s-text3 p-b-5">
										${product.name}
									</a>

									${price(product)}
								</div>
							</div>
						</div>
    `;
  }

  return {
    init: init,
    render: render
  }
})();

$(document).ready(function () {
  let namespace = $("body").data("namespace");
  switch (namespace) {
    case "all-products":
      allProducts.init();
      allProducts.render();
      break;
  }
});