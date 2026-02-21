<?php
require 'header.php';

// エラー表示を有効にする（開発時のみ使用してください）
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// $stepの初期値を設定
$step = 1;

// 合計値を保持する変数
$total = 2500;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // ステップ１の項目
  $floors      = isset($_POST['floors']) ? $_POST['floors'] : '';
  $ldk_size    = isset($_POST['ldk_size']) ? $_POST['ldk_size'] : '';
  $ldk_katachi = isset($_POST['ldk_katachi']) ? $_POST['ldk_katachi'] : '';
  $kids        = isset($_POST['kids']) ? $_POST['kids'] : '';
  $washitsu    = isset($_POST['washitsu']) ? $_POST['washitsu'] : '';
  
  // ステップ進行用フラグ（ステップ５は廃止）
  $step2 = isset($_POST['step2']) ? $_POST['step2'] : false;
  $step3 = isset($_POST['step3']) ? $_POST['step3'] : false;
  $step4 = isset($_POST['step4']) ? $_POST['step4'] : false;
  $step6 = isset($_POST['step6']) ? $_POST['step6'] : false;
  
  if ($step2) $step = 2;
  if ($step3) $step = 3;
  if ($step4) $step = 4;
  if ($step6) $step = 6;
  
  // 前のステップまでの合計値を取得
  $total = isset($_POST['total']) ? intval($_POST['total']) : 2500;
  
  // 各ステップで選択された値を合計に加算
  if ($step == 2) {
    // ステップ１での選択内容
    $total += intval($floors) + intval($ldk_size) + intval($ldk_katachi) + intval($kids) + intval($washitsu);
  } elseif ($step == 3) {
    // ステップ２（キッチン・ダイニング）
    $total += intval($_POST['kitchen']) + intval($_POST['dining']);
  } elseif ($step == 4) {
    // ステップ３（寝室収納・衣服収納）
    $total += intval($_POST['shinshitsu']) + intval($_POST['irui']);
  } elseif ($step == 6) {
    // ステップ４（本来は元のステップ４の質問内容）
    // 玄関、階段、バルコニー、吹き抜け、洗面所の加算
    $total += intval($_POST['genkan']) + intval($_POST['kaidan']) + intval($_POST['veranda']) + intval($_POST['fukinuke']) + intval($_POST['senmen']);
  }
  
  if ($step == 6) {
    // 合計値に応じた最終結果用URLの決定
    if ($total >= 2250 && $total < 2400) {
      $p = 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=ca7JuS';
    } elseif ($total >= 2400 && $total < 2550) {
      $p = 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=Y9C0Pa';
    } elseif ($total >= 2550 && $total < 2700) {
      $p = 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=fSRwxT';
    } elseif ($total >= 2700 && $total < 2850) {
      $p = 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=cqtjEz';
    } elseif ($total >= 2850 && $total < 3000) {
      $p = 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=nQVLS2';
    } elseif ($total >= 3000 && $total < 3150) {
      $p = 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=dDxxuw';
    } elseif ($total >= 3150 && $total < 3300) {
      $p = 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=BZCF5V';
    } elseif ($total >= 3300 && $total < 3450) {
      $p = 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=fTgnnP';
    } elseif ($total >= 3450 && $total < 3600) {
      $p = 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=G9ezW8';
    } elseif ($total >= 3600 && $total <= 3900) {
      $p = 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=8N58H3';
    }
  }
}
?>

<div class="sn top-main">
  
  <header class="sn-header">
    <h1 class="">
      <img src="assets/img/logo.png" class="" alt="">
    </h1>
  </header>
  
  <div class="sn-step">
    <img src="assets/img/s-h-<?php echo $step; ?>.png" class="" alt="">
  </div>
  
  <div class="sn-content">
    
    <?php if ($step != 6): ?>
    <div class="sn-bar">
      <img src="assets/img/s-b-<?php echo $step; ?>.png" class="" alt="">
    </div>
    <?php endif; ?>
    
    <form action="./step.php" method="post" id="stepForm" novalidate>
      <!-- 合計値を次のステップに引き継ぐ -->
      <input type="hidden" name="total" value="<?php echo $total; ?>">
      
      <?php if ($step == 1): ?>
      <input type="hidden" name="step2" value="true">
      
      <!-- 何階建て -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            何階建てがいい？
          </div>
          <div class="sn-q__txt">
            家の階数もライフスタイルに合わせてご選択ください。
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-list">
          <label class="sn-q-list__item">
            <input type="radio" name="floors" value="100" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">① 平屋</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
          <label class="sn-q-list__item">
            <input type="radio" name="floors" value="0" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">② 2階建</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
          <label class="sn-q-list__item">
            <input type="radio" name="floors" value="200" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">③ 3階建</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
        </div>
      </div>
      
      <!-- LDK -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            LDKの帖数は？
          </div>
          <div class="sn-q__txt">
            LDK（リビング・ダイニング・キッチン）の広さで家族のくつろぎ方が変わります。何帖が理想ですか？
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-2.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①18帖以下
            </div>
            <input type="radio" name="ldk_size" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-1-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②18~23帖
            </div>
            <input type="radio" name="ldk_size" value="150" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-1-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ③23帖以上
            </div>
            <input type="radio" name="ldk_size" value="200" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-1-3.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
        </div>
      </div>
      
      <!-- LDKの形は？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            LDKの形は？
          </div>
          <div class="sn-q__txt">
            LDK（リビング・ダイニング・キッチン）の形で空間の印象が変わります。使いやすい形を選んでくださいね。
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①縦型
            </div>
            <input type="radio" name="ldk_katachi" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-2-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②L型
            </div>
            <input type="radio" name="ldk_katachi" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-2-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ③正方形型
            </div>
            <input type="radio" name="ldk_katachi" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-2-3.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
        </div>
      </div>
      
      <!-- 子ども部屋は？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            子ども部屋は？
          </div>
          <div class="sn-q__txt">
            子ども部屋は必要ですか？ 将来を見据えて1部屋、2部屋、3部屋とお選びいただけます。
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-list">
          <label class="sn-q-list__item">
            <input type="radio" name="kids" value="0" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">① いらない</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
          <label class="sn-q-list__item">
            <input type="radio" name="kids" value="0" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">② 1部屋</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
          <label class="sn-q-list__item">
            <input type="radio" name="kids" value="50" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">③ 2部屋</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
          <label class="sn-q-list__item">
            <input type="radio" name="kids" value="100" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">④ 3部屋</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
        </div>
      </div>
      
      <!-- 和室 -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            和室はほしい？
          </div>
          <div class="sn-q__txt">
            和室は落ち着く場所。LDKと一緒か独立か、どちらがいいですか？
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①不要、それよりもLDK で広く
            </div>
            <input type="radio" name="washitsu" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-3-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②LDK一体型タタミコーナ
            </div>
            <input type="radio" name="washitsu" value="100" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-3-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ③独立型の広い和室
            </div>
            <input type="radio" name="washitsu" value="200" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-3-3.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
        </div>
      </div>
      
      <?php elseif ($step == 2): ?>
      <input type="hidden" name="step3" value="true">
      
      <!-- お好みのキッチンのスタイルは？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            お好みのキッチンのスタイルは？
          </div>
          <div class="sn-q__txt">
            キッチンは奥様のこだわり部分！料理を楽しくするための機能とスタイルを選びましょう。
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①ー型キッチン
            </div>
            <input type="radio" name="kitchen" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-4-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②アイランドキッチン
            </div>
            <input type="radio" name="kitchen" value="50" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-4-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ③ L型キッチン
            </div>
            <input type="radio" name="kitchen" value="50" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-4-3.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ④ニの字型キッチン
            </div>
            <input type="radio" name="kitchen" value="100" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-4-4.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
        </div>
      </div>
      
      <!-- キッチンとダイニングの位置関係は？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            キッチンとダイニングの位置関係は？
          </div>
          <div class="sn-q__txt">
            キッチンとダイニングの配置はデザインとスムーズな動線に関係します。どちらがお好みですか？
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-2.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①縦並び
            </div>
            <input type="radio" name="dining" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-5-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②横並び
            </div>
            <input type="radio" name="dining" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-5-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
        </div>
      </div>
      
      <?php elseif ($step == 3): ?>
      <input type="hidden" name="step4" value="true">
      
      <!-- お好みの寝室収納は？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            お好みの寝室収納は？
          </div>
          <div class="sn-q__txt">
            寝室の収納はどうしますか？ クローゼットでシンプルに、ウォークインで広々と取ることもできます。
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①クローゼット(部屋の広さ優先)
            </div>
            <input type="radio" name="shinshitsu" value="30" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-6-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②ウォークインクローゼット
            </div>
            <input type="radio" name="shinshitsu" value="50" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-6-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
        </div>
        <div class="sn-q-list">
          <label class="sn-q-list__item">
            <input type="radio" name="shinshitsu" value="0" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">③ 不要（部屋の広さ優先）</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
        </div>
      </div>
      
      <!-- お好みの衣服収納は？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            お好みの衣服収納は？
          </div>
          <div class="sn-q__txt">
            衣類収納のスタイルはどうしますか？各部屋に分ける or 一箇所に集中どちらがご希望ですか？
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①各部屋個別収納
            </div>
            <input type="radio" name="irui" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-7-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②ファミクロ
            </div>
            <input type="radio" name="irui" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-7-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
        </div>
        <div class="sn-q-list">
          <label class="sn-q-list__item">
            <input type="radio" name="irui" value="50" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">③両方欲しい</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
        </div>
      </div>
      
      <?php elseif ($step == 4): ?>
      <!-- ステップ５（廃止）を削除し、ここで最終ステップ（step6）へ進む -->
      <input type="hidden" name="step6" value="true">
      
      <!-- お好みの玄関は？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            お好みの玄関は？
          </div>
          <div class="sn-q__txt">
            収納の形で玄関のスッキリさが変わってきます。
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①土問収納無しスッキリ
            </div>
            <input type="radio" name="genkan" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-8-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②ウォークスルー2WAY
            </div>
            <input type="radio" name="genkan" value="80" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-8-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ③土問収納で収納多め
            </div>
            <input type="radio" name="genkan" value="40" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-8-3.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
        </div>
      </div>
      
      <!-- お好みの階段は？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            お好みの階段は？
          </div>
          <div class="sn-q__txt">
            リビング階段にすることによりお子様と必ず顔を合わせるスタイルになったりデザインの一部になったりもします。
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①リビング階段
            </div>
            <input type="radio" name="kaidan" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-9-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②ホール階段
            </div>
            <input type="radio" name="kaidan" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-9-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <!-- <label class="sn-q-img-list__item">
              <div class="sn-q-img-list__ttl">
                ③スケルトン階段
              </div>
              <input type="radio" name="kaidan" value="50" class="sn-q-img-list__radio" required>
              <div class="sn-q-img-list__content">
                <img src="assets/img/s-9-3.jpg" alt="" class="sn-q-img-list__image">
              </div>
            </label> -->
        </div>
        <div class="sn-q-list">
          <label class="sn-q-list__item">
            <input type="radio" name="kaidan" value="0" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">③平屋の方はこちら</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
        </div>
      </div>
      
      <!-- ベランダは必要？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            バルコニーは必要？
          </div>
          <div class="sn-q__txt">
            最近は設置する方が減っているバルコニーですが、洗濯物の外干しが出来ない方は要検討！
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-list">
          <label class="sn-q-list__item">
            <input type="radio" name="veranda" value="100" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">① 必要</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
          <label class="sn-q-list__item">
            <input type="radio" name="veranda" value="0" class="sn-q-list__radio" required>
            <span class="sn-q-list__button">
              <span class="sn-q-list__text">② 不要</span>
              <span class="sn-q-list__select">タップで選択</span>
            </span>
          </label>
        </div>
      </div>
      
      <!-- 吹き抜けは必要？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            吹き抜けは必要？
          </div>
          <div class="sn-q__txt">
            吹き抜けがあると空間に開放感が生まれます。ありかなしか選択ください。
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-2.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①あり
            </div>
            <input type="radio" name="fukinuke" value="50" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-10-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②なし
            </div>
            <input type="radio" name="fukinuke" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-10-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
        </div>
      </div>
      
      <!-- お好みの洗面所は？ -->
      <div class="sn-q">
        <div class="sn-q__heading">
          <div class="sn-q__ttl">
            お好みの洗面所は？
          </div>
          <div class="sn-q__txt">
            脱衣室と分けるといつでも気軽に使えるので最近は別々にする方が増えてきました。
          </div>
          <div class="sn-q__pic">
            <img src="assets/img/s-a-1.png" class="" alt="">
          </div>
        </div>
        <div class="sn-q-img-list">
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ①洗面、脱衣は別
            </div>
            <input type="radio" name="senmen" value="70" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-11-1.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
          <label class="sn-q-img-list__item">
            <div class="sn-q-img-list__ttl">
              ②洗面、脱衣一体型で広く
            </div>
            <input type="radio" name="senmen" value="0" class="sn-q-img-list__radio" required>
            <div class="sn-q-img-list__content">
              <img src="assets/img/s-11-2.jpg" alt="" class="sn-q-img-list__image">
            </div>
          </label>
        </div>
      </div>
      
      <?php elseif ($step == 6): ?>
      
      <div class="sn-kekka">
        <div class="sn-kekka__ttl">
          診断結果が作られました
        </div>
        <div class="sn-kekka__txt">
          LINE登録をして<br>
          あなたの理想のお家を建てるのに<br>
          必要な予算を受け取って下さい。
        </div>
        <a href="<?php echo $p; ?>" class="sn-kekka__btn">
          <img src="assets/img/s-line.png" class="" alt="">
        </a>
      </div>
      
      <?php endif; ?>
      
      <?php if ($step != 6): ?>
      <div id="errorMessage" style="color: red; text-align: center; margin-top: 10px; display: none;">
        選択していない項目があります
      </div>
      
      <button type="submit" class="sn-submit-button" id="submitButton" style="opacity: 0.5;" disabled>
        <img src="assets/img/t-13.png" alt="送信">
      </button>
      <?php endif; ?>
      
    </form>
    
  </div>
  
</div>

<?php require 'footer.php'; ?>