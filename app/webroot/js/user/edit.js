$(function() {
	$.fn.autoKana('#firstLastName', '#firstLastName-furigana', {
		katakana: true,
	});
});

$(function () {
	$(document).on('change', '#area', function () {
		var thisVal = $(this).val(); //選択された自分の値
		var selectedPref = prefectureArr[thisVal]; //thisValに対応するキーのPrefecture配列を変数に代入
		var len = Object.keys(selectedPref).length; //Object.keys()で配列のキーだけ取得できる
		var insertHtml = '';
		for (i = 1; i < len + 1; i++) {
			//lengthの数だけ下記を繰り返し、処理を行う。
			insertHtml += `<option value="${i}">${selectedPref[i]}</option>`; //　<option value="${i}">が各都道府県に対応するキー、${selectedPref[i]}がそのまま都道府県名が入る。+=で文字列連携代入
		}
		$('#prefecture').html("").append(insertHtml); //#prefectureセレクト要素にhtml()で代入。
	});

	$(document).on('focus', '#datepicker', function () {
		$('#datepicker').attr('readonly', true);
	});

	$(document).on('focusout', '#datepicker', function () {
		$('#datepicker').removeAttr('readonly');
	});

	$(document).on('contextmenu', '#datepicker', function () {
		return false;
	});

});
