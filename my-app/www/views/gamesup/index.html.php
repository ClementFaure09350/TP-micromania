<body class="bg-gray-100 ">
    <div class="bg-gradient-to-r from-black to-blue-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 py-12">
            <h2 class="text-4xl font-bold uppercase text-green-700 mb-10">Quel jeu voulez vous supprimer ?</h2>

            <!-- Games Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($game) && is_array($game)): ?>
                    <?php foreach ($game as $g): ?>
                        <div class="bg-gray-900 border-2 border-orange-600 rounded-lg overflow-hidden p-4">
                            <div class="mb-4">
                                <h3 class="text-lg font-bold text-orange-400"><?= htmlspecialchars($g->title ?? ($g->description ?? 'Titre')) ?></h3>
                                <p class="text-sm text-gray-400">Prix: <?= htmlspecialchars(isset($g->price) ? number_format((float)$g->price, 2, ',', ' ') . '€' : 'N/A') ?></p>
                            </div>

                            <div class="flex gap-2">
                                <a href="/gamesup/edit?id=<?= htmlspecialchars((string)($g->id ?? '')) ?>" class="px-3 py-2 bg-blue-600 rounded text-sm">Éditer</a>

                                <form action="/gamesup/delete" method="post" onsubmit="return confirm('Supprimer ce jeu ?');" class="inline">
                                    <input type="hidden" name="game_id" value="<?= htmlspecialchars((string)($g->id ?? '')) ?>">
                                    <button type="submit" class="px-3 py-2 bg-red-600 hover:bg-red-700 rounded text-sm text-white">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center text-gray-400 p-8 border-2 border-dashed border-gray-800 rounded">
                        Aucun jeu trouvé.
                    </div>
                <?php endif; ?>
            </div>
