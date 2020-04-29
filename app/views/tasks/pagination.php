<?php
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

    if ($currPage === 1) {
        $backEnabled = ' disabled';
        $aBack = '<span class="page-link" aria-hidden="true">‹</span>';

    } elseif ($currPage === count($tasks)) {
        $forwardEnabled = ' disabled';
        $aForward = '<span class="page-link" aria-hidden="true">›</span>';
    }

    echo '
        <div class="row col-sm-12 pagination">
            <ul class="pagination" role="navigation">

                <li class="page-item' . $backEnabled . '" aria-disabled="true" aria-label="« Назад">
                    ' . $aBack . '
                </li>';

    foreach ($tasks as $page => $task) {
        if ($currPage === ($page + 1)) {
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
            </ul>
        </div>';
}
