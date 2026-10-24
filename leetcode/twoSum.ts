function twoSum(nums: number[], target: number): number[] {
    const subtractionsMap = new Map<number, number>();
    for (let i = nums.length; i--; ) {
        subtractionsMap.set(target - nums[i], i);
    }
    for (let i = nums.length; i--; ) {
        if (subtractionsMap.has(nums[i])) {
            const otherIndex = subtractionsMap.get(nums[i]);
            if (otherIndex !== i) {
                return [otherIndex, i];
            }
        }
    }
}
const nums = [2,7,11,15];
const target = 9;
console.log(twoSum(nums, target));