  $(document).ready(function() {
      $(".like-btn").click(function likeAction(event) {
          event.preventDefault();
          var element = event.currentTarget;
          var post_id = element.parentNode.dataset.postid;
          var like = element.dataset.value != '0';
          $.ajax({
              type: 'POST',
              url: likeUrl,
              data: {
                  post_id: post_id,
                  like: like,
                  _token: token
              },
              complete: function(data) {
                  if (data.status == 200) {
                      if (element.firstChild.classList.contains("fa-2x")) {
                          element.firstChild.classList.remove("fa-2x");
                      } else {
                          for (var child of $(element).parent().children()) {
                              child.firstChild.classList.remove("fa-2x");
                          }
                          element.firstChild.classList.add("fa-2x");

                      }
                  }

              }
          });
      });
  });
