function loadDay() {
    Year = document.getElementById('ddlYear');
    Month = document.getElementById('ddlMonth');
    Day = document.getElementById('ddlDay');
    // parseInt: chuyen kieu Month.value tu String sang Int
    var mon = parseInt(Month.options[Month.selectedIndex].value);
    var day = parseInt(Day.options[Day.selectedIndex].value);
    // Dat bien SoDay de lam gia tri cuoi cho dong lap phat sinh ngay
    var SoDay = 30;
    // Thuc hien cac dong lenh sau dua tren viec so sanh gia tri Month
    switch (mon) {
        // Truong hop thang 2
        case 2:
            // Lay gia tri Year dang duoc chon trong ddlYear
            var gtYear = parseInt(Year.options[Year.selectedIndex].value);
            // Thuat toan tinh nam nhuan
            if ((gtYear % 4 == 0) && ((gtYear % 100 != 0) || (gtYear % 400 == 0))) {
                if (day < 29 && Day.length == 29) {
                    return;
                }
                // La nam nhuan
                SoDay = 29;
            }
            else {
                if (day < 30 && Day.length == 28) {
                    return;
                }
                // Khong la nam nhuan
                SoDay = 28;
            }
            break;
            // Truong hop cac thang 1, 3, 5, 7, 8, 10, 12
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            if (day < 32 && Day.length == 31) {
                return;
            }
            SoDay = 31;
            break;
            // Truong hop cac thang 4, 6, 9, 11
        case 4:
        case 6:
        case 9:
        case 11:
            if (day < 31 && Day.length == 30) {
                return;
            }
            SoDay = 30;
            break;
        default :
            SoDay = 30;
    }
    Day.length = 0;
    // Cho vong lap chay tu 1 den SoDay o tren
    for (var iDay = 1; iDay <= SoDay; iDay++) {
        var optDay = document.createElement('option');
        optDay.text = iDay;
        optDay.value = iDay;
        Day.options.add(optDay);
    }
}

function validatePass() {
    var newPass = document.getElementById('newPass').value;
    var confirmPass = document.getElementById('confirmPass').value;
    if (newPass != confirmPass) {
        alert('Confirm Password does not match New Password');
        return false;
    }
    return true;
}

function checkMinMax() {
    var minS = document.getElementById('minValue').value;
    var maxS = document.getElementById('maxValue').value;
    if ((minS.length > 0) && (maxS.length > 0)) {
        var minN = parseFloat(minS);
        var maxN = parseFloat(maxS);
        if (minN >= maxN) {
            alert('Please fill in the appropriate price range');
            return false;
        }
    }
    return true;
}

//Check whether filling in img fileds in order or not
function checkSubImage() {
    var img1 = document.getElementById('txtImage1').value;
    var img2 = document.getElementById('txtImage2').value;
    var img3 = document.getElementById('txtImage3').value;
    var img4 = document.getElementById('txtImage4').value;
    var isNeedAlert = false;
    if (img1.length === 0 && img2.length === 0 && img3.length === 0 && img4.length === 0) {
        return;
    } else if (img1.length === 0 && img2.length > 0) {
        isNeedAlert = true;
    } else if ((img1.length === 0 || img2.length === 0) && img3.length > 0) {
        isNeedAlert = true;
    }else if ((img1.length === 0 || img2.length === 0 || img3.length === 0) && img4.length > 0) {
        isNeedAlert = true;
    }
    //alert
    if (isNeedAlert) {
        alert('Please fill in sub image fileds in order');
    }
}