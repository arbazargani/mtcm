    <!-- Load React. -->
    <!-- Note: when deploying, replace "development.js" with "production.min.js". -->
    <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>

    <!-- Load our React component. -->
    <script type="text/javascript" src="/js/app.js"></script>

    <!-- Theme mode switcher. -->
    <script>
        function switch_theme(mode) {

            const switches = document.getElementsByClassName('uk-section');

            for (let item of switches) {
                item.classList.remove('uk-light');
                item.classList.remove('uk-background-secondary');
                item.classList.remove('uk-section-secondary');
                item.classList.remove('uk-section-default');
                item.classList.add('uk-background-default');
                item.classList.add('uk-dark');
            }

        }
    </script>
