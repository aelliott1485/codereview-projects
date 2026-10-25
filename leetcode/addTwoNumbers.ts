/**
 * Definition for singly-linked list.
 * class ListNode {
 *     val: number
 *     next: ListNode | null
 *     constructor(val?: number, next?: ListNode | null) {
 *         this.val = (val===undefined ? 0 : val)
 *         this.next = (next===undefined ? null : next)
 *     }
 * }
 */

function addTwoNumbers(l1: ListNode | null, l2: ListNode | null): ListNode | null {
    let lastNext: ListNode;
    let carry = false;
    const digits = new Array<number>();
    for (let l1Next = l1, l2Next = l2; l1Next || l2Next || carry; l1Next = l1Next?.next, l2Next = l2Next?.next) {
        const val = (l1Next?.val || 0) + (l2Next?.val || 0) + (carry ? 1 : 0);
        digits.push(val > 9 ? val - 10: val);
        carry = (val > 9) ;
    }
    if (carry) {
        lastNext = new ListNode(1);
    }
    for (let i = digits.length; i--;) {
        lastNext = new ListNode(digits[i], lastNext);
    }
    return lastNext;
};
