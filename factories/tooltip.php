<?php
function createTooltip($tooltip, $id)
{
  ob_start();
  $funcName = $id . 'ClickHandler';
  $toolTipId = $id .'-tooltip';
?>
  <div class="tooltip">
    <button type="button" class="icon-info2" onclick="<?= $funcName; ?>()"><span>See tooltip</span></button>
    <span class="information" id="<?= $toolTipId; ?>">
      <?= $tooltip; ?>
    </span>
  </div>
  <script>
    function <?= $funcName; ?>() {
      const info = document.getElementById("<?= $toolTipId; ?>")

      if (info.style.display === 'block') {
        hideTooltip()
      } else {
        info.style.display = 'block'
        setTimeout(() => {
          document.addEventListener('click', clickListener)
        }, 0)
      }

      function clickListener(e) {
        if (!e.path.includes(info)) {
          hideTooltip()
        }
      }

      function hideTooltip() {
        info.style.removeProperty('display')
        document.removeEventListener('click', clickListener)
      }
    }
  </script>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>