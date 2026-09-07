// Source - https://codereview.stackexchange.com/q/230486/120114
// Posted by Muhammad Azizi Abdul Aziz, modified by community. See post 'Timeline' for change history
// Retrieved 2026-09-05, License - CC BY-SA 4.0

document.addEventListener('DOMContentLoaded', function () {
    var app = new Vue({
        el: '#app',
        data: {
            lrDividerPos: '',
            rtbDividerPos: '',
            ltbDividerPos: '',
        },
        computed: {
            bottomLeftStyle: function() {
                const style = {};
                if (this.lrDividerPos) {
                    style.width = this.lrDividerPos + 'px';
                }
                if (this.ltbDividerPos) {
                    style.height = (window.innerHeight - this.ltbDividerPos) + 'px';
                    style.top = this.ltbDividerPos + 'px';
                }
                return style;
            },
            bottomRightStyle: function() {
                const style = {};
                if (this.lrDividerPos) {
                    style.left = this.lrDividerPos + 'px';
                    style.width = (window.innerWidth - this.lrDividerPos + 2) + 'px';
                }
                if (this.rtbDividerPos) {
                    style.top = this.rtbDividerPos + 'px';
                    style.height = (window.innerHeight - this.rtbDividerPos) + 'px';
                }
                return style;
            },
            leftDividerStyles: function() {
                if (this.lrDividerPos) {
                    return {
                        width: (this.lrDividerPos + 2) + 'px'
                    };
                }
                return {};
            },
            ltbDividerStyles: function() {
                const style = {};
                if (this.lrDividerPos) {
                    style.width = this.lrDividerPos + 2 + 'px';
                }
                if (this.ltbDividerPos) {
                    style.top = this.ltbDividerPos + 'px';
                }
                return style;
            },
            lrDividerStyles: function() {
                if (this.lrDividerPos) {
                    return {
                        left: this.lrDividerPos + 'px'
                    };
                }
                return {};
            },
            rtbDividerStyles: function() {
                const style = {};
                if (this.lrDividerPos) {
                    style.left = this.lrDividerPos + 'px';
                    style.width = (window.innerWidth - this.lrDividerPos + 2) + 'px';
                }
                if (this.rtbDividerPos) {
                    style.top = this.rtbDividerPos + 'px';
                }
                return style;
            },
            topLeftStyle: function() {
                const style = {};
                if (this.ltbDividerPos) {
                    style.height = this.ltbDividerPos + 'px';
                }
                if (this.lrDividerPos) {
                    style.width = this.lrDividerPos + 'px';
                }
                return style;
            },
            topRightStyle: function() {
                const style = {};
                if (this.lrDividerPos) {
                    style.left = this.lrDividerPos + 'px';
                    style.width = (window.innerWidth - this.lrDividerPos + 2) + 'px';
                }
                if (this.rtbDividerPos) {
                    style.height = this.rtbDividerPos + 'px';
                }
                return style;
            }
        },
        methods: {
            lrDividerDrag: function(e) {
                if (e.clientX) {
                    this.lrDividerPos = e.clientX;
                }
            },
            ltbDividerDrag: function(e) {
                if (e.clientY) {
                    this.ltbDividerPos = e.clientY;
                }
            },
            rtbDividerDrag: function(e) {
                if (e.clientY) {
                    this.rtbDividerPos = e.clientY;
                }
            },
            dividerDragStart: function(e) {
                e.dataTransfer.setDragImage(new Image, 0, 0);
            }
        }
    });
});