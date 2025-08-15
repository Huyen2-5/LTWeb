<?php
// Hàm tính tổng
function tinh_tong($a, $b) {
    return $a + $b;
}

// Hàm tính hiệu
function tinh_hieu($a, $b) {
    return $a - $b;
}

// Hàm tính tích
function tinh_tich($a, $b) {
    return $a * $b;
}

// Hàm tính thương
function tinh_thuong($a, $b) {
    if ($b != 0) {
        return $a / $b;
    } else {
        return "Không thể chia cho 0";
    }
}

// Hàm kiểm tra số nguyên tố
function la_nguyen_to($n) {
    if ($n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

// Hàm kiểm tra số chẵn
function la_so_chan($n) {
    return $n % 2 == 0;
}
?>
