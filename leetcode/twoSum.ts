function twoSum(nums: number[], target: number): number[] {
    const subtractions = [];
    for (let i = nums.length; i--; ) {
        subtractions[i] = target - nums[i];
    }
    for (let i = nums.length; i--; ) {
        const indexOfOtherNum = subtractions.indexOf(nums[i]);
        if (indexOfOtherNum > -1 && indexOfOtherNum !== i) {
            return [indexOfOtherNum, i];
        }
    }
}
const nums = [2,7,11,15];
const target = 9;
console.log(twoSum(nums, target));