//شروع جدا سازی سه رقمی
// تابع برای معکوس کردن یک رشته
function funcReverseString(str) {
    return str.split('').reverse().join('');
}

// مدیریت رویداد برای جداسازی اعداد
function handlerSeparateNumbers(e) {
    const thisElement = e.target; // المان ورودی که رویداد روی آن اجرا می‌شود
    let thisElementValue = thisElement.value; // مقدار فعلی ورودی

    // حذف کاماها از مقدار ورودی
    thisElementValue = thisElementValue.replace(/,/g, "");

    // بررسی اینکه مقدار ورودی عدد است یا نه
    if (isNaN(Number(thisElementValue))) {
        alert("لطفا از وارد کردن حروف خودداری فرمایید!");
        return false;
    }

    // معکوس کردن رشته برای سه رقم سه رقم جدا کردن
    let seperatedNumber = funcReverseString(thisElementValue);
    seperatedNumber = seperatedNumber.split("");

    let tmpSeperatedNumber = "";
    let j = 0;

    // اضافه کردن کاما بعد از هر سه رقم
    for (let i = 0; i < seperatedNumber.length; i++) {
        tmpSeperatedNumber += seperatedNumber[i];
        j++;
        if (j == 3 && i != seperatedNumber.length - 1) {
            tmpSeperatedNumber += ",";
            j = 0;
        }
    }

    // معکوس کردن دوباره رشته برای بازگرداندن به حالت اصلی
    seperatedNumber = funcReverseString(tmpSeperatedNumber);
    
    // حذف کاما اضافی در صورت وجود
    if (seperatedNumber[0] === ",") {
        seperatedNumber = seperatedNumber.replace(",", "");
    }

    // تنظیم مقدار ورودی با عدد جدا شده
    thisElement.value = seperatedNumber;
}
//پایان جدا سازی سه رقمی
function printPage() {
    window.print();
}
function goBack() {
    window.history.back();
}