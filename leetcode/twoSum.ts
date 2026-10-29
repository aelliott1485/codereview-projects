/**
* Reduce computations to a single loop
* Runtime: 2ms, Beats 74.33%
* Memory: 57.46MB, Beats 31.74%
*/
function twoSum(nums: number[], target: number): number[] {
    const subtractionsMap = new Map<number, number>();
    for (let i = nums.length; i--; ) {
        if (subtractionsMap.has(nums[i])) {
            return [subtractionsMap.get(nums[i]), i];
        }
        subtractionsMap.set(target - nums[i], i);
    }
}
const nums = [2,7,11,15];
const target = 9;
console.log(twoSum(nums, target));