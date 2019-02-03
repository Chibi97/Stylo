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
    products: [],
    filters: []
  };

  let rootNode, filtersNode;

  function init() {
    rootNode = $("#products");
    filtersNode  = $(".product-filter");

    fetchData();
    addEventListeners();
  }

  function fetchData() {
    setTimeout(function() {
      state.products = [
        {
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
      ];
      render();
    }, 1000)
  }

  function addEventListeners() {
    filtersNode.each(function() {
      let filter = $(this);
      filter.click(function(e) {
        e.preventDefault();
        let node = $(this);
        let f = node.data("filter");
        if(!node.hasClass('active1')) {
          state.filters.push(f);
          node.addClass('active1');
        } else {
            let index = state.filters.indexOf(f);
            state.filters.splice(index, 1);
            node.removeClass('active1');
        }
        
      });
    });
  }

  function dependecies() {
    $('.block2-btn-addcart').each(function () {
      var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
      $(this).on('click', function () {
        swal(nameProduct, "is added to cart !", "success");
      });
    });

    $('.block2-btn-addwishlist').each(function () {
      var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
      $(this).on('click', function () {
        swal(nameProduct, "is added to wishlist !", "success");
      });
    });

    $('.btn-addcart-product-detail').each(function () {
      var nameProduct = $('.product-detail-name').html();
      $(this).on('click', function () {
        swal(nameProduct, "is added to wishlist !", "success");
      });
    });

    $('.block2-btn-addwishlist').on('click', function (e) {
      e.preventDefault();
      $(this).addClass('block2-btn-towishlist');
      $(this).removeClass('block2-btn-addwishlist');
      $(this).off('click');
    });
  }

  function render() {
    rootNode.html("");
    let html = "";
    state.products.forEach((product) => {
      html += template(product)
    });
    rootNode.html(html);
    dependecies();
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
  /* shared js */

  /* component js */
  switch (namespace) {
    case "all-products":
      allProducts.init();
      allProducts.render();
      break;
  }
});