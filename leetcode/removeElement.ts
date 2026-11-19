/*
* Leetcode:
* Runtime: 0ms Beats 100.00%
* Memory: 56.74MB Beats 5.77%
*/
function removeElement(nums: number[], val: number): number {
    let removed = 0;
    const total = nums.length;
    for (let i = nums.length; i--;) {
        if (nums[i] === val) {
            nums.splice(i, 1);
            removed++;
        }
    }
    return total - removed;
};
