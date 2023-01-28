
<div class="container mx-auto">
    <div class="text-2xl font-medium text-center text-gray-500 border-b border-gray-200 ">
        <ul class="flex flex-wrap -mb-px">
            <li class="mr-2">
                <a href="./" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 ">
                    Domovská stránka
                </a>
            </li>
           <?php if(!isset($_SESSION['LOGGED_IN_USER_ID'])): ?>

            <li class="mr-2">
                <a href="register.php" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                    Registrace
                </a>
            </li>
            <li class="mr-2">
                <a href="login.php" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 ">
                    Přihlášení
                </a>
            </li>
            <?php else: ?>
            <li class="mr-2">
                <a href="logout.php" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 ">
                    Odhlášení
                </a>
            </li>
            <?php endif; ?>

        </ul>
    </div>
</div>