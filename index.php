<?php require 'header.php'; ?>


<div class="top">

  <div class="top-pc pc">


    <div class="top-pc__shindan">
      <div class="top-s6-txt">
        \ まずはこれ /
      </div>
      <div class="top-shindan">
        <div class="top-shindan-label">
          <img src="assets/img/t-19.png" class="" alt="">
        </div>
        <div class="top-shindan-head">
          <img src="assets/img/t-3.png" class="" alt="">
        </div>
        <div class="top-shindan-body">
          <div class="top-shindan-1">
            <img src="assets/img/t-4.png" class="" alt="">
          </div>
          <div class="top-shindan-2">
            <div class="image-grid">
              <form action="./step.php" method="post" id="shindanForm">
                <div class="image-grid">
                  <?php for ($i = 5; $i <= 12; $i++): ?>
                    <div class="image-item">
                      <input type="checkbox" id="checkbox<?php echo $i; ?>" class="hidden-checkbox" name="room[]" value="<?php echo $i; ?>">
                      <label for="checkbox<?php echo $i; ?>">
                        <img src="assets/img/t-<?php echo $i; ?>.jpg" alt="部屋<?php echo $i; ?>">
                        <span class="checkmark"></span>
                      </label>
                    </div>
                  <?php endfor; ?>
                </div>
                <button class="next-button">
                  <img src="assets/img/t-13.png" class="" alt="">
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

  <div class="top-main">

    <div class="top-header">
      <div class="header-inner">
        <div class="header-logo">
          <img src="./assets/img/logo.png" alt="logo">
        </div>
        <a href="./step.php">
          <img src="assets/img/t-1.png" class="" alt="">
        </a>
      </div>
    </div>

    <div class="top-content">

      <div class="top-fv">
        <img src="assets/img/t-2.png" class="" alt="">
      </div>

      <div class="top-s1">
        <div class="top-shindan">
          <div class="top-shindan-head">
            <img src="assets/img/t-3.png" class="" alt="">
          </div>
          <div class="top-shindan-body">
            <div class="top-shindan-1">
              <img src="assets/img/t-4.png" class="" alt="">
            </div>
            <div class="top-shindan-2">
              <div class="image-grid">
                <form action="./step.php" method="post" id="shindanForm">
                  <div class="image-grid">
                    <?php for ($i = 5; $i <= 12; $i++): ?>
                      <div class="image-item">
                        <input type="checkbox" id="checkbox<?php echo $i; ?>" class="hidden-checkbox" name="room[]" value="<?php echo $i; ?>">
                        <label for="checkbox<?php echo $i; ?>">
                          <img src="assets/img/t-<?php echo $i; ?>.jpg" alt="部屋<?php echo $i; ?>">
                          <span class="checkmark"></span>
                        </label>
                      </div>
                    <?php endfor; ?>
                  </div>
                  <button class="next-button">
                    <img src="assets/img/t-13.png" class="" alt="">
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="top-s2">
        <img src="assets/img/t-14.png" class="" alt="">
      </div>
      <div class="top-s3">
        <img src="assets/img/t-15.png" class="" alt="">
      </div>
      <div class="top-s4">
        <img src="assets/img/t-16.png" class="" alt="">
      </div>
      <div class="top-s5">
        <img src="assets/img/t-17.png" class="" alt="">
      </div>

      <div class="top-s6">
        <div class="top-s6-txt">
          \ まずはこれ /
        </div>
        <div class="top-shindan">
          <div class="top-shindan-label">
            <img src="assets/img/t-19.png" class="" alt="">
          </div>
          <div class="top-shindan-head">
            <img src="assets/img/t-3.png" class="" alt="">
          </div>
          <div class="top-shindan-body">
            <div class="top-shindan-1">
              <img src="assets/img/t-4.png" class="" alt="">
            </div>
            <div class="top-shindan-2">
              <div class="image-grid">
                <form action="./step.php" method="post" id="shindanForm">
                  <div class="image-grid">
                    <?php for ($i = 5; $i <= 12; $i++): ?>
                      <div class="image-item">
                        <input type="checkbox" id="checkbox<?php echo $i; ?>" class="hidden-checkbox" name="room[]" value="<?php echo $i; ?>">
                        <label for="checkbox<?php echo $i; ?>">
                          <img src="assets/img/t-<?php echo $i; ?>.jpg" alt="部屋<?php echo $i; ?>">
                          <span class="checkmark"></span>
                        </label>
                      </div>
                    <?php endfor; ?>
                  </div>
                  <button class="next-button">
                    <img src="assets/img/t-13.png" class="" alt="">
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="top-s6">
        <img src="assets/img/t-18.png" class="" alt="">
      </div>

    </div>
  </div>

</div>



<script>
  document.querySelectorAll('.image-item label').forEach(label => {
    label.addEventListener('click', function(e) {
      e.preventDefault();
      const checkbox = this.previousElementSibling;
      checkbox.checked = !checkbox.checked;
      this.classList.toggle('checked');
    });
  });

  document.querySelectorAll('#shindanForm').forEach(form => {
    form.addEventListener('submit', function(e) {
      const checkedRooms = this.querySelectorAll('input[name="room[]"]:checked');
      if (checkedRooms.length === 0) {
        e.preventDefault();
        alert('少なくとも1つの部屋を選択してください。');
      }
    });
  });
</script>

<?php require 'footer.php'; ?>