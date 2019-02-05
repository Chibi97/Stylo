function observe(obj, fn) {
  Object.keys(obj).forEach((key) => {
    let v = obj[key];
    Object.defineProperty(obj, key, {
      get: function () {
        return v;
      },
      set: function (value) {
        v = value;
        fn(key);
      }
    })
  });
}

let allProducts = (function () {
  let state = {
    products: [],
    filters: [],
    categories: []
  };

  let rootNode, filtersNode, categoriesNode;

  function onStateChanged(key) {
    if(key === "products") {
      render();
      return;
    }

    httpHelper.post("products.php", {
      filters: state.filters,
      categories: state.categories
    }, (products) => { 
      console.log(products);
      state.products = products 
    })
  }

  function init() {
    rootNode        = $("#products");
    filtersNode    = $(".product-filter");
    categoriesNode = $(".site-category");

    fetchData();
    addEventListeners();
    
    observe(state, onStateChanged);
  }

  function fetchData() {
    httpHelper.get("products.php", (products) => {
      state.products = products;
    });
  }

  function addEventListeners() {
    filtersNode.click(function(e) {
      e.preventDefault();
      let node = $(this);
      let f = node.data('filter');
      if(!node.hasClass('active1')) {
        state.filters = [...state.filters, f]
        node.addClass('active1');
      } else {
          let index = state.filters.indexOf(f);
          state.filters = 
            state.filters.filter((_, i) => i != index);
          node.removeClass('active1');
      }
    });
    
    categoriesNode.click(function(e) {
      e.preventDefault();
      let node = $(this);
      let c = node.data('category');

      if(c === 'All') {
        categoriesNode.removeClass('active1');
        state.categories = [];
        node.addClass('active1');
        return;
      } else {
        categoriesNode.each(function() {
          var n = $(this);
          if(n.data('category') === 'All') {
            n.removeClass('active1');
            return;
          }
        });
      }

      if(!node.hasClass('active1')) {
        state.categories = [...state.categories, c]
        node.addClass('active1')
      } else {
        let index = state.categories.indexOf(c);
        state.categories = 
          state.categories.filter((_, i) => i != index);
        node.removeClass('active1');
      }
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

  function isOnSale(stateSale) {
    console.log(stateSale)
    if(!stateSale) {
      return '';
    }
    return `<div class="label-product label-sale">
              <p>Sale</p>
            </div>`;
  }

  function isProductNew(stateNew, stateSale) {
    if(stateNew == 0) {
      var sale = isOnSale(stateSale);
      if(!sale) {
        return ``;
      }
      return sale;
    }
    return `<div class="label-product label-new">
              <p>New</p>
            </div>`;
  }

  function template(product) {
    return `
      <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                  ${ isProductNew(product.new, product.sale) }
									<img src="${product.init_image}" alt="${product.alt}">

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