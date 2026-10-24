function isPalindrome(x: number): boolean {
    if (x < 0) {
        return false;
    }
    if (x < 10) {
        return true;
    }
    const stringNumber = x.toString();
    for (let i = stringNumber.length -1; i--; ) {
        if (stringNumber[i] != stringNumber[stringNumber.length - i - 1]) {
            return false;
        }
    }
    return true;
};
console.log(isPalindrome(919));