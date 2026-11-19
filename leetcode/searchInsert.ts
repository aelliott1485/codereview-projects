/*
* Runtime 1ms Beats16.72%
* Memory 60.12MB Beats 5.55%
*/
function searchInsert(nums: number[], target: number): number {
    const numsLength = nums.length;
    for (let i = numsLength; i--;) {
        if (nums[i] > target) {
            if (i && nums[i -1] < target) {
                return i;
            }
        } else if (nums[i] < target) {
            return i + 1;
        }
        if (nums[i] === target) {
            return i;
        }
    }
    return 0;
};
