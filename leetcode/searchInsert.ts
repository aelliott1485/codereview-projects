/*
* Runtime 0ms Beats 100.00%
* Memory 56.48MB Beats 10.75%
*/
function searchInsert(nums: number[], target: number): number {
    let leftPointer = 0;
    let rightPointer = nums.length - 1;
    while (leftPointer <= rightPointer) {
        let midPoint = Math.floor((rightPointer + leftPointer) / 2);
        if (nums[midPoint] < target) {
            leftPointer = midPoint + 1;
        } else if (nums[midPoint] > target) {
            rightPointer = midPoint - 1;
        } else {
            return midPoint;
        }
    }
    return leftPointer;
};
