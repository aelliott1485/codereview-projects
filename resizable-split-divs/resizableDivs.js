// Source - https://codereview.stackexchange.com/q/230486/120114
// Posted by Muhammad Azizi Abdul Aziz, modified by community. See post 'Timeline' for change history
// Retrieved 2026-09-05, License - CC BY-SA 4.0

var dividerRef = '';
var currentDivider = null;

var leftDivider = null;
var rightDivider = null;
var leftRightDivider = null;

var topLeft = null;
var topRight = null;
var bottomLeft = null;
var bottomRight = null;
document.addEventListener('DOMContentLoaded', function () {
    var app = new Vue({
        el: '#app',
        methods:
            {
                dividerDragStart: function(e) {
                    e.dataTransfer.setDragImage(new Image, 0, 0);
                },
                dividerDrag: function(e) {
                    if (dividerRef == 'lrDivider') {
                        currentDivider.style.left = e.clientX + 'px';

                        leftDivider.style.width = (e.clientX + 2) + 'px';

                        rightDivider.style.left = (e.clientX) + 'px';
                        rightDivider.style.width = (window.innerWidth - e.clientX + 2) + 'px';

                        topLeft.style.width = e.clientX + 'px';
                        bottomLeft.style.width = e.clientX + 'px';

                        topRight.style.left = e.clientX + 'px';
                        topRight.style.width = (window.innerWidth - e.clientX + 2) + 'px';
                        bottomRight.style.left = e.clientX + 'px';
                        bottomRight.style.width = (window.innerWidth - e.clientX + 2) + 'px';
                    } else if (dividerRef == 'rtbDivider') {
                        currentDivider.style.top = (e.clientY) + 'px';

                        topRight.style.height = (e.clientY) + 'px'

                        bottomRight.style.height = (window.innerHeight - e.clientY) + 'px';
                        bottomRight.style.top = (e.clientY) + 'px';
                    } else if (dividerRef == 'ltbDivider') {
                        currentDivider.style.top = (e.clientY) + 'px';

                        topLeft.style.height = (e.clientY) + 'px'

                        bottomLeft.style.height = (window.innerHeight - e.clientY) + 'px';
                        bottomLeft.style.top = (e.clientY) + 'px';
                    }
                },
                dividerMouseDown: function(name) {
                    dividerRef = name;
                    currentDivider = this.$refs[dividerRef];
                },
                dividerDragEnd: function(e) {
                    if (dividerRef == 'lrDivider') {
                        currentDivider.style.left = e.clientX + 'px';
                        leftDivider.style.width = (e.clientX + 2) + 'px';

                        rightDivider.style.left = (e.clientX) + 'px';
                        rightDivider.style.width = (window.innerWidth - e.clientX + 2) + 'px';

                        topLeft.style.width = e.clientX + 'px';
                        bottomLeft.style.width = e.clientX + 'px';

                        topRight.style.left = e.clientX + 'px';
                        topRight.style.width = (window.innerWidth - e.clientX + 2) + 'px';
                        bottomRight.style.left = e.clientX + 'px';
                        bottomRight.style.width = (window.innerWidth - e.clientX + 2) + 'px';
                    } else if (dividerRef == 'rtbDivider') {
                        currentDivider.style.top = (e.clientY) + 'px';

                        topRight.style.height = (e.clientY) + 'px'

                        bottomRight.style.height = (window.innerHeight - e.clientY) + 'px';
                        bottomRight.style.top = (e.clientY) + 'px';
                    } else if (dividerRef == 'ltbDivider') {
                        currentDivider.style.top = (e.clientY) + 'px';

                        topLeft.style.height = (e.clientY) + 'px'

                        bottomLeft.style.height = (window.innerHeight - e.clientY) + 'px';
                        bottomLeft.style.top = (e.clientY) + 'px';
                    }

                    dividerRef = '';
                    currentDivider = null;
                }
            },
        mounted() {
            topLeft = this.$refs.topLeft;
            topRight = this.$refs.topRight;
            bottomLeft = this.$refs.bottomLeft;
            bottomRight = this.$refs.bottomRight;

            var heightHalf = (window.innerHeight - 80) / 2;
            var widthHalf = window.innerWidth / 2;

            leftDivider = this.$refs.ltbDivider;
            rightDivider = this.$refs.rtbDivider;
            leftRightDivider = this.$refs.lrDivider;
        }
    })
})