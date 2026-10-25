function isPalindrome(x: number): boolean {
    if (x < 0) {
        return false;
    }
    if (x < 10) {
        return true;
    }
    const digits = Array<number>();
    for (let value = x; value >= 1; value /= 10) {
        digits.push(Math.floor(value%10));
    }
    const digitsLength = digits.length;
    for (let i = digitsLength; i-- > digitsLength / 2;) {
        if (digits[i] != digits[digitsLength - i - 1]) {
            return false;
        }
    }
    return true;
};
console.log(isPalindrome(919));