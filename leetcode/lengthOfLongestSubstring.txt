function lengthOfLongestSubstring(s: string): number {
    if (s.length < 2) {
        return s.length;
    }
    let longestLength = 1;
    let subString = '';
    for (let i = s.length; i-- > 1;) {
        subString = `${s[i]}`;
        for (let j = i; j--;) {
            if (subString.indexOf(s[j]) !== -1) {
                if (longestLength < subString.length) {
                   longestLength = subString.length;
                }
                subString = '';
                break;
            }        
            subString = `${s[j]}${subString}`;
        }
        if (longestLength < subString.length) {
            longestLength = subString.length;
        }
    }
    return Math.max(longestLength, subString.length);
};