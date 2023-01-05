<?php

include '../include/getTasks.php';

try {
    $tasksJSON = getTasks();

} catch (Exception $e) {
    echo 'exception: ' . $e->getMessage();
    $tasksJSON = '{}';
}
?>



<html>
<head>
    <title>Duga Tasks</title>
    <link rel="stylesheet" type="text/css" href="//unpkg.com/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//unpkg.com/bootstrap-vue@2.23.0/dist/bootstrap-vue.css">

    <!--<script type="text/javascript" src="//vuejs.org/js/vue.js"></script>
    <script type="text/javascript" src="//unpkg.com/vue"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script type="text/javascript" src="//unpkg.com/bootstrap-vue@2.23.0/dist/bootstrap-vue.js"></script>
    <script type="text/javascript" src="//unpkg.com/bootstrap-vue@2.23.0/dist/bootstrap-vue-icons.js"></script>
    <style>
        body {
            background-image: url("https://cdn.sstatic.net/Sites/codereview/img/background-image.png?v=f93b5df604a8");
        }
        }
    </style>
</head>
<body>
<div id="msg"></div>
<div id="app">
    <h2>Tasks</h2>
    <b-card-group deck>
        <b-card
            v-for="task in tasks"
            border-variant="primary"
            :header="task.name"
            header-bg-variant="primary"
            header-text-variant="white"
            align="center"

        >
            <b-card-text :alt="task.last">
                {{ formatDate(task.last) }}
            </b-card-text>
        </b-card>
    </b-card-group deck>
</div>
<script type="text/javascript">
    const URL = 'https://duga.zomis.net/tasks';
    const messageConstainer = document.getElementById('msg');

    new Vue({
        el: '#app',
        data: {
            tasks: <?= $tasksJSON ?>, //{},
            loading: false
        },
        methods: {
            formatDate: function(timestamp) {
                console.log(`timestamp: ${timestamp}`)
                const date = new Date(0);
                date.setUTCSeconds(timestamp);
                return date.toLocaleString(); //date.toISOString('en-GB');
            }
        }
    });
    async function loadData() {
        try {
            // const response = await fetch(URL);
            const data = <?= $tasksJSON ?>;
            //this.tasks = data;

            const lastCommentsScan = data['Comments scanning'].last;
            const lastCommentsScanDate = new Date(data['Comments scanning'].last);
            //messageConstainer.innerHTML = `last scan: ${lastCommentsScan} date: ${lastCommentsScanDate.toISOString('en-GB')}`;

        } catch (e) {
            messageConstainer.innerHTML = `error: ${e.message}`;
        }
    }

    loadData();
</script>
</body>
</html>