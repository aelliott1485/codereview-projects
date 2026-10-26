const MAX_32_BIT_INTEGER = 2**31 - 1;
function reverse(x: number): number {
    if (Math.abs(x) < 10) {
        return x;
    }
    const negative = x < 0;
    const output = Number(`${negative ? Math.abs(x) : x}`.split('').reverse().join(''));
    if (output > MAX_32_BIT_INTEGER) {
        return 0;
    }
    return negative ? -1 * output : output;
};