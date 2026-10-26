function isValid(s: string): boolean {
    if (s.length%2 === 1) {
        return false;
    }
    const MAPPING = {'(': ')', '{': '}', '[': ']'}
    const queue = new Array<string>();
    for (let i = s.length; i--;) {
        if (['(', '{', '['].includes(s[i])) {
            if (!queue.length || !queue.includes(MAPPING[s[i]])) {
                return false;
            }
            if (MAPPING[s[i]] === queue[0]) {
                queue.shift();
            }
        } else if ([')', '}', ']'].includes(s[i])) {
            queue.unshift(s[i]);
        }
    }
    return queue.length === 0;
};