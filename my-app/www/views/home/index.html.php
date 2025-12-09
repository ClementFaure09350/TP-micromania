<body class="bg-gray-100 ">
    <div class="bg-gradient-to-r from-black to-blue-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 py-12">
            <h2 class="text-4xl font-bold uppercase text-green-700 mb-10">Jeux Populaires</h2>

            <!-- Games Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <?php if (!empty($game) && is_array($game)): ?>
                    <?php foreach ($game as $g): ?>
                        <div class="bg-gray-900 border-2 border-green-600 rounded-lg overflow-hidden hover:shadow-lg hover:shadow-green-800/100 hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                            <div class="w-full h-64 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center text-gray-600 text-sm">
                                <?php if (!empty($g->image)): ?>
                                    <img src="<?= htmlspecialchars($g->image) ?>" alt="<?= htmlspecialchars($g->title ?? 'jeu') ?>" class="object-cover w-full h-full">
                                <?php else: ?>
                                    Image du jeu
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-green-500 mb-2"><?= htmlspecialchars($g->title ?? ($g->description ?? 'Titre indisponible')) ?></h3>
                                <p class="text-2xl font-bold text-white mb-2"><?= htmlspecialchars(isset($g->price) ? number_format((float)$g->price, 2, ',', ' ') . '€' : 'N/A') ?></p>
                                <p class="text-sm text-gray-400 mb-4">Stock: <?= htmlspecialchars((string)($g->stock ?? '0')) ?></p>
                                <form action="/basket/add" method="post" class="mt-2">
                                    <input type="hidden" name="game_id" value="<?= htmlspecialchars((string)($g->id ?? '')) ?>">
                                    <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 transition font-bold rounded">
                                        Ajouter au panier
                                    </button>
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
        </div>
    </div>
</body>
</html>