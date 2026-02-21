let currentStep = 1;

// LINE URL マッピング
const budgetRanges = [
  { min: 2250, max: 2400, url: 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=ca7JuS' },
  { min: 2400, max: 2550, url: 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=Y9C0Pa' },
  { min: 2550, max: 2700, url: 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=fSRwxT' },
  { min: 2700, max: 2850, url: 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=cqtjEz' },
  { min: 2850, max: 3000, url: 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=nQVLS2' },
  { min: 3000, max: 3150, url: 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=dDxxuw' },
  { min: 3150, max: 3300, url: 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=BZCF5V' },
  { min: 3300, max: 3450, url: 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=fTgnnP' },
  { min: 3450, max: 3600, url: 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=G9ezW8' },
  { min: 3600, max: 3900, url: 'https://s.lmes.jp/landing-qr/2006477439-oNGlmxx1?uLand=8N58H3' }
];

// ステップ表示切替
function showStep(stepId) {
  document.querySelectorAll('.step').forEach(function(s) {
    s.classList.remove('active');
  });
  document.getElementById('step' + stepId).classList.add('active');
  history.pushState({ step: stepId }, '', '#step' + stepId);
  window.scrollTo(0, 0);
}

// 次へ
function nextStep() {
  if (!validateCurrentStep()) return;

  if (currentStep < 5) {
    currentStep++;
    showStep(currentStep);
  } else if (currentStep === 5) {
    var result = calculateResult();
    var selectedStatus = Array.from(document.querySelectorAll('input[name="current-status"]:checked'))
      .map(function(input) { return input.value; });
    var selectedIncome = (document.querySelector('input[name="household-income"]:checked') || {}).value;

    var hasAdvancedStatus = selectedStatus.some(function(status) {
      return status === '住宅会社と契約し打ち合わせ中' ||
             status === '着工済み' ||
             status === '完成or引っ越し済み';
    });
    var isLowIncome = selectedIncome === '~399万円';

    if (hasAdvancedStatus || isLowIncome) {
      // 6a: 予算金額表示
      var budgetEl = document.getElementById('budgetAmount');
      budgetEl.textContent = result.range.min.toLocaleString() + '~' + result.range.max.toLocaleString();
      currentStep = '6a';
    } else {
      // 6b: LINE誘導
      var lineLink = document.getElementById('lineLink');
      lineLink.href = result.range.url;
      lineLink.setAttribute('target', '_blank');
      currentStep = '6b';
    }
    showStep(currentStep);
  }
}

// 戻る
function previousStep() {
  if (currentStep === '6a' || currentStep === '6b') {
    currentStep = 5;
  } else if (currentStep > 1) {
    currentStep--;
  }
  showStep(currentStep);
}

// スコア計算
function calculateResult() {
  var total = 2500;
  var radioNames = ['floors', 'ldk_size', 'ldk_katachi', 'kids', 'washitsu',
                     'kitchen', 'dining', 'shinshitsu', 'irui',
                     'genkan', 'kaidan', 'veranda', 'fukinuke', 'senmen'];

  radioNames.forEach(function(name) {
    var checked = document.querySelector('input[name="' + name + '"]:checked');
    if (checked) {
      total += parseInt(checked.value, 10) || 0;
    }
  });

  var range = budgetRanges[budgetRanges.length - 1];
  for (var i = 0; i < budgetRanges.length; i++) {
    if (total >= budgetRanges[i].min && total < budgetRanges[i].max) {
      range = budgetRanges[i];
      break;
    }
  }
  // 最後の範囲は <= で判定
  if (total >= budgetRanges[budgetRanges.length - 1].min) {
    range = budgetRanges[budgetRanges.length - 1];
  }

  return { total: total, range: range };
}

// バリデーション
function validateCurrentStep() {
  var step = currentStep;
  var requiredRadios = [];
  var requiredCheckboxes = [];

  if (step === 1) {
    requiredRadios = [
      { name: 'floors', label: '階数を選択してください。' },
      { name: 'ldk_size', label: 'LDKの広さを選択してください。' },
      { name: 'ldk_katachi', label: 'LDKの形を選択してください。' },
      { name: 'kids', label: '子ども部屋について選択してください。' },
      { name: 'washitsu', label: '和室について選択してください。' }
    ];
  } else if (step === 2) {
    requiredRadios = [
      { name: 'kitchen', label: 'キッチンのスタイルを選択してください。' },
      { name: 'dining', label: 'キッチンとダイニングの配置を選択してください。' }
    ];
  } else if (step === 3) {
    requiredRadios = [
      { name: 'shinshitsu', label: '寝室収納を選択してください。' },
      { name: 'irui', label: '衣服収納を選択してください。' }
    ];
  } else if (step === 4) {
    requiredRadios = [
      { name: 'genkan', label: '玄関のタイプを選択してください。' },
      { name: 'kaidan', label: '階段のタイプを選択してください。' },
      { name: 'veranda', label: 'バルコニーの必要性を選択してください。' },
      { name: 'fukinuke', label: '吹き抜けの有無を選択してください。' },
      { name: 'senmen', label: '洗面所のタイプを選択してください。' }
    ];
  } else if (step === 5) {
    requiredCheckboxes = [
      { name: 'reference-media', label: '参考にしている媒体を選択してください。' },
      { name: 'current-status', label: '現在の状況を選択してください。' }
    ];
    requiredRadios = [
      { name: 'household-income', label: '世帯年収を選択してください。' }
    ];
  }

  // ラジオボタンチェック
  for (var i = 0; i < requiredRadios.length; i++) {
    var r = requiredRadios[i];
    if (!document.querySelector('input[name="' + r.name + '"]:checked')) {
      alert(r.label);
      scrollToQuestion(r.name);
      return false;
    }
  }

  // チェックボックスチェック
  for (var j = 0; j < requiredCheckboxes.length; j++) {
    var c = requiredCheckboxes[j];
    if (document.querySelectorAll('input[name="' + c.name + '"]:checked').length === 0) {
      alert(c.label);
      scrollToQuestion(c.name);
      return false;
    }
  }

  return true;
}

// 未回答質問へスクロール
function scrollToQuestion(name) {
  var el = document.querySelector('[data-question="' + name + '"]');
  if (!el) {
    var input = document.querySelector('input[name="' + name + '"]');
    if (input) el = input.closest('.sn-q');
  }
  if (!el) return;

  var pos = el.getBoundingClientRect().top + window.pageYOffset - 100;
  try {
    window.scrollTo({ top: pos, behavior: 'smooth' });
  } catch (e) {
    window.scrollTo(0, pos);
  }

  // ハイライト
  el.style.border = '3px solid #ff6347';
  el.style.borderRadius = '8px';
  el.style.backgroundColor = '#fff5f5';
  el.style.transition = 'all 0.3s ease';
  setTimeout(function() {
    el.style.border = '';
    el.style.borderRadius = '';
    el.style.backgroundColor = '';
  }, 3000);
}

// 初期化
document.addEventListener('DOMContentLoaded', function() {
  // チェックボックスの選択スタイル
  var checkboxes = document.querySelectorAll('.sn-q-list__checkbox');
  checkboxes.forEach(function(cb) {
    cb.addEventListener('change', function() {
      var btn = this.nextElementSibling;
      if (this.checked) {
        btn.style.backgroundColor = '#57852A';
        btn.style.borderColor = '#57852A';
        btn.querySelectorAll('.sn-q-list__text, .sn-q-list__select').forEach(function(el) {
          el.style.color = '#fff';
        });
      } else {
        btn.style.backgroundColor = '#fff';
        btn.style.borderColor = '#65441A';
        btn.querySelectorAll('.sn-q-list__text, .sn-q-list__select').forEach(function(el) {
          el.style.color = '';
        });
      }
    });
  });

  // ブラウザの戻る/進むボタン対応
  window.addEventListener('popstate', function(event) {
    if (event.state && event.state.step) {
      currentStep = event.state.step;
      showStep(currentStep);
    }
  });

  // 初期状態
  history.replaceState({ step: 1 }, '', '#step1');
});
