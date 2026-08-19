<footer class="footer">
  <div class="footer__list">
    <a href="company.html" target="_blank">
      会社概要
    </a>
    <a href="privacy.html" target="_blank">
      プライバシーポリシー
    </a>
  </div>
</footer>
</div>


<!-- ページ内遷移用 -->
<script type="text/javascript">
  $(function() {
    $('a[href^="#"]').click(function() {
      var speed = 200;
      var href = $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top;
      $("html, body").animate({
        scrollTop: position
      }, speed, "swing");
      return false;
    });
  });
</script>

<!-- 追従ボタン設定 -->
<!-- <script>
  $(function() {
    var btn = $('.kotei-btn');

    $(window).on('load scroll', function() {
      if ($(this).scrollTop() > 1000) {
        var height = $(document).height(),
          position = window.innerHeight + $(window).scrollTop(),
          footer = $('.c-footer').offset().top;
        if (position > footer) {
          btn.removeClass('is-active');
        } else {
          btn.addClass('is-active');
        }
      } else {
        btn.removeClass('is-active');
      }
    });

  });
</script> -->

<!-- スクロールイベント用 -->
<script>
  function js_scroll() {
    $(".js-scroll").each(function() {
      var position = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height() / 1.1;
      if (scroll > position - windowHeight) {
        $(this).addClass("is-active");
      }
    });
  };
  window.onload = function() {
    js_scroll();
  }
  $(window).scroll(function() {
    js_scroll();
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('stepForm');
    if (form) {
      var submitButton = document.getElementById('submitButton');
      var errorMessage = document.getElementById('errorMessage');

      function checkFormValidity() {
        var requiredFields = form.querySelectorAll('input[required], select[required]');
        var isValid = true;

        requiredFields.forEach(function(field) {
          if (field.type === 'radio') {
            var radioGroup = form.querySelectorAll('input[name="' + field.name + '"]');
            var radioChecked = false;
            radioGroup.forEach(function(radio) {
              if (radio.checked) {
                radioChecked = true;
              }
            });
            if (!radioChecked) {
              isValid = false;
            }
          } else if (!field.value) {
            isValid = false;
          }
        });

        submitButton.disabled = false; // 常に送信ボタンを有効にする
        submitButton.style.opacity = isValid ? '1' : '0.5';
        errorMessage.style.display = 'none';
      }

      form.addEventListener('change', checkFormValidity);

      form.addEventListener('submit', function(e) {
        e.preventDefault(); // フォームの送信を一時的に停止
        console.log('ボタンが押されました');

        var requiredFields = form.querySelectorAll('input[required], select[required]');
        var isValid = true;

        requiredFields.forEach(function(field) {
          if (field.type === 'radio') {
            var radioGroup = form.querySelectorAll('input[name="' + field.name + '"]');
            var radioChecked = false;
            radioGroup.forEach(function(radio) {
              if (radio.checked) {
                radioChecked = true;
              }
            });
            if (!radioChecked) {
              isValid = false;
            }
          } else if (!field.value) {
            isValid = false;
          }
        });

        if (!isValid) {
          errorMessage.style.display = 'block';
        } else {
          form.submit(); // フォームを送信
        }
      });

      // 初期状態のチェック
      checkFormValidity();
    }
  });
</script>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TPC7KHQ4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>