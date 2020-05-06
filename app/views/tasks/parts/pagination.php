<div class="col-sm-12 pagination">
    <ul class="pagination" role="navigation">


        <?php
        $tasks ??= [];

        if (count($tasks) > 1) {

            $backEnabled = $forwardEnabled = '';
            $aForward = '
        <a class="page-link" 
            href="/task/index?page=' . count($tasks) . '" rel="next" 
            aria-label="Вперёд »">›</a>';
            $aBack = '
        <a class="page-link' . $forwardEnabled . '" 
                    href="/task/index?page=' . count($tasks) . '" rel="next" 
                    aria-label="« Назад">‹</a>';

            if (!isset($vars)) {
                $vars = [];
            }
            if ($vars['currPage'] === 1) {
                $backEnabled = ' disabled';
                $aBack = '<span class="page-link" aria-hidden="true">‹</span>';

            } elseif ($vars['currPage'] === count($tasks)) {
                $forwardEnabled = ' disabled';
                $aForward = '<span class="page-link" aria-hidden="true">›</span>';
            }

            echo '
                <li class="page-item' . $backEnabled . '" aria-disabled="true" aria-label="« Назад">
                    ' . $aBack . '
                </li>';

            foreach ($tasks as $page => $task) {
                if ($vars['currPage'] === ($page + 1)) {
                    echo '
                <li class="page-item active" aria-current="page"><span class="page-link">'
                        . ($page + 1)
                        . '</span></li>';
                } else {
                    echo '
                <li class="page-item"><a class="page-link" href="/task/index?page='
                        . ($page + 1) . '">' . ($page + 1) . '</a></li>';
                }
            }

            echo '
                <li class="page-item' . $forwardEnabled . '">
                    
                    ' . $aForward . '
                </li>
';
        } else {
            echo '<li><span class="page-link dump">&nbsp;</span></li>';
        }
        ?>


    </ul>
</div>

