<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="bg-gradient-to-r from-black to-blue-900 min-h-screen">
        <main class="max-w-6xl mx-auto px-4 py-12">

            <h1 class="text-4xl font-bold uppercase text-green-700 mb-10">Votre panier</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Items list -->
                <section class="lg:col-span-2 space-y-6">

                    <!-- Item -->
                    <div class="p-2 bg-gray-900 border-2 border-green-600 rounded-lg overflow-hidden hover:shadow-lg hover:shadow-green-800/100 hover:-translate-y-1 transition-all duration-300 cursor-pointer flex">
                        <div class="w-full sm:w-48 h-36 bg-gradient-to-br from-gray-800 to-gray-900 rounded flex items-center justify-center text-gray-600">
                            Image
                        </div>
                        <div class="flex-1 p-4">
                            <div class="flex justify-between items-start">
                                <div class="">
                                    <h3 class="text-lg font-semibold text-green-700">Titre du jeu</h3>
                                    <div class="flex gap-2">
                                        <h3 class="text-medium font-semibold text-green-700">Plateforme</h3>
                                        <h3 class="text-medium font-semibold text-green-700">Type</h3>
                                    </div>
                                </div>
                                <button class="text-sm text-white bg-red-900 border border-red-500 m-1 hover:text-red-200">Supprimer</button>
                            </div>

                            <div class="gap-6 mt-4 flex items-center text-sm sm:text-base">
                                <div class="">
                                    <h1 class="text-white">Quantité</h1>
                                </div>
                                <div class="col-span-6 sm:col-span-2 flex items-center gap-2">

                                    <div class="flex items-center border rounded overflow-hidden bg-gray-800">
                                        <h2 class="w-12 text-center bg-gray-800 text-white">1</h2>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-2 text-right text-white font-bold" data-subtotal>49.99€</div>
                            </div>
                        </div>
                    </div>

                    <!-- Item (example 2) -->
                    <div class="p-2 bg-gray-900 border-2 border-green-600 rounded-lg overflow-hidden hover:shadow-lg hover:shadow-green-800/100 hover:-translate-y-1 transition-all duration-300 cursor-pointer flex">
                        <div class="w-full sm:w-48 h-36 bg-gradient-to-br from-gray-800 to-gray-900 rounded flex items-center justify-center text-gray-600">
                            Image
                        </div>
                        <div class="flex-1 p-4">
                            <div class="flex justify-between items-start">
                                <div class="">
                                    <h3 class="text-lg font-semibold text-green-700">Titre du jeu</h3>
                                    <div class="flex gap-2">
                                        <h3 class="text-medium font-semibold text-green-700">Plateforme</h3>
                                        <h3 class="text-medium font-semibold text-green-700">Type</h3>
                                    </div>
                                </div>
                                <button class="text-sm text-white bg-red-900 border border-red-500 m-1 hover:text-red-200">Supprimer</button>
                            </div>

                            <div class="gap-6 mt-4 flex items-center text-sm sm:text-base">
                                <div class="">
                                    <h1 class="text-white">Quantité</h1>
                                </div>
                                <div class="col-span-6 sm:col-span-2 flex items-center gap-2">

                                    <div class="flex items-center border rounded overflow-hidden bg-gray-800">
                                        <h2 class="w-12 text-center bg-gray-800 text-white">1</h2>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-2 text-right text-white font-bold" data-subtotal>49.99€</div>
                            </div>
                        </div>
                    </div>

                </section>

                <!-- Order summary -->
                 <!-- p-2 bg-gray-900 border-2 border-green-600 rounded-lg overflow-hidden hover:shadow-lg hover:shadow-green-800/100 hover:-translate-y-1 transition-all duration-300 cursor-pointer flex -->
                <aside class="bg-gray-900 border-2 border-green-600 rounded-lg p-6 h-fit">
                    <h2 class="text-xl font-semibold text-green-700 mb-4">Récapitulatif</h2>

                    <div class="flex justify-between text-gray-300 mb-2">
                        <span>Sous-total</span>
                        <span id="summary-subtotal">169.97€</span>
                    </div>

                    <div class="flex justify-between text-gray-300 mb-2">
                        <span>Frais de port</span>
                        <span id="summary-shipping">4.99€</span>
                    </div>

                    <div class="border-t border-gray-800 pt-4 mb-6">
                        <div class="flex justify-between items-center text-lg font-bold">
                            <span class="text-green-700">Total</span>
                            <span id="summary-total" class="text-blue-600">209.95€</span>
                        </div>
                    </div>

                    <button class="w-full py-2 bg-blue-600 hover:bg-blue-700 transition font-bold rounded">Passer la commande</button>
                </aside>
            </div>

        </main>
    </div>