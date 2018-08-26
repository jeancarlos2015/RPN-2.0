<head>
    <meta charset="UTF-8" />
    <title>Hello World</title>

    <!-- viewer distro -->
    <script src="https://unpkg.com/bpmn-js@2.4.1/dist/bpmn-viewer.development.js"></script>

    <!-- needed for this example only -->
    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.js"></script>

    <!-- example styles -->
    <style>
        html, body, #canvas {
            height: 100%;
            padding: 0;
            margin: 0;
        }

        .diagram-note {
            background-color: rgba(66, 180, 21, 0.7);
            color: White;
            border-radius: 5px;
            font-family: Arial;
            font-size: 12px;
            padding: 5px;
            min-height: 16px;
            width: 50px;
            text-align: center;
        }

        .needs-discussion:not(.djs-connection) .djs-visual > :nth-child(1) {
            stroke: rgba(66, 180, 21, 0.7) !important; /* color elements as red */
        }
    </style>
</head>