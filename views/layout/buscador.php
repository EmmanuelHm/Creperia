<?php if( !isset($_SESSION['admin']) ): ?>

<div id="search" class="p-3">
    <form action="<?=base_url?>buscador/index" method="POST">
        <input type="search" name="search"  placeholder="Buscar porducto" required>
        <input type="submit"  class="m-2" value="Buscar" >
    </form>
</div>

<?php endif; ?>