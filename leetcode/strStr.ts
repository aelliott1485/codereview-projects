/*
* Runtime 0ms Beats 100.00%
* Memory 56.32 MB Beats 27.12%
*/
function strStr(haystack: string, needle: string): number {
    const limit = haystack.length - needle.length;
    const needleLength = needle.length;
    outerLoop: for (let i = 0; i <= limit; i++) {
        for (let j = 0; j < needleLength; j++) {
            if (haystack[i + j] !== needle[j]) {
                continue outerLoop;
            }
            if (j === needleLength - 1) {
                return i;
            }
        }
    }
    return -1;
};
