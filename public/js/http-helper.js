let httpHelper = (function () {
  function get(uri, success, fail = (xhr) => console.log(xhr.status)) {
    $.ajax({
      url: `/api/${uri}`,
      method: "get",
      dataType: "json",
      success: success,
      error: fail
    });
  }

  function post(uri, data, success, fail = (xhr) => console.error(xhr.status) ) {
    $.ajax({
      url: `/api/${uri}`,
      method: "post",
      dataType: "json",
      data: data,
      success: success,
      error: fail
    })
  }

  return {
    get: get,
    post: post
  }
})();