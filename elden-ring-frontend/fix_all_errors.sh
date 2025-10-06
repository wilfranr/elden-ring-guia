#!/bin/bash

# Script para corregir todos los archivos HTML con errores de estructura

# Función para crear un archivo de lista básico
create_list_file() {
    local file_path="$1"
    local title="$2"
    local description="$3"
    local item_name="$4"
    local go_to_function="$5"
    
    cat > "$file_path" << EOF
<div class="flex flex-col min-h-screen">
  <main class="flex-grow">
    <div class="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
      <div class="mb-8">
        <h2 class="text-4xl font-bold tracking-tight text-content-light dark:text-content-dark">$title</h2>
        <p class="mt-2 text-lg text-content-light/80 dark:text-content-dark/80">$description</p>
      </div>

      <div class="space-y-6">
        <div>
          <h3 class="text-sm font-semibold uppercase tracking-wider text-content-light/70 dark:text-content-dark/70 mb-3">Filtrar por Categoría</h3>
          <div class="flex flex-wrap gap-2">
            <button
              class="px-4 py-2 rounded-full text-sm font-medium"
              [ngClass]="{
                'bg-primary text-white': selectedCategory() === 'All',
                'bg-surface-light dark:bg-surface-dark hover:bg-content-light/5 dark:hover:bg-content-dark/5 transition-colors': selectedCategory() !== 'All'
              }"
              (click)="setCategory('All')"
            >Todos</button>
            <ng-container *ngFor="let c of getUniqueCategories()">
              <button
                class="px-4 py-2 rounded-full text-sm font-medium"
                [ngClass]="{
                  'bg-primary text-white': selectedCategory() === c,
                  'bg-surface-light dark:bg-surface-dark hover:bg-content-light/5 dark:hover:bg-content-dark/5 transition-colors': selectedCategory() !== c
                }"
                (click)="setCategory(c)"
              >{{ c }}</button>
            </ng-container>
          </div>
        </div>

        <div>
          <h3 class="text-sm font-semibold uppercase tracking-wider text-content-light/70 dark:text-content-dark/70 mb-3">Ordenar por</h3>
          <div class="flex flex-wrap gap-2">
            <ng-container *ngFor="let s of ['Name', 'Category']">
              <button
                class="px-4 py-2 rounded-full text-sm font-medium"
                [ngClass]="{
                  'bg-secondary text-content-light': selectedSort() === s,
                  'bg-surface-light dark:bg-surface-dark hover:bg-content-light/5 dark:hover:bg-content-dark/5 transition-colors': selectedSort() !== s
                }"
                (click)="setSort(s)"
              >{{ s }}</button>
            </ng-container>
          </div>
        </div>
      </div>

      <div *ngIf="isLoading()" class="mt-8 text-center text-sm text-content-light/80 dark:text-content-dark/80">Cargando $item_name…</div>
      <div *ngIf="!isLoading() && errorMessage()" class="mt-8 text-center text-red-500">{{ errorMessage() }}</div>
      <div *ngIf="!isLoading() && !errorMessage()" class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
        <div class="group flex flex-col overflow-hidden rounded-lg bg-surface-light dark:bg-surface-dark shadow-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-1 cursor-pointer" 
             *ngFor="let item of filteredAndSorted()" 
             (click)="$go_to_function(item.id)">
          <div class="aspect-square w-full overflow-hidden">
            <div class="h-full w-full bg-cover bg-center transition-transform duration-300 group-hover:scale-110" [style.background-image]="'url(' + item.image + ')'">
            </div>
          </div>
          <div class="p-4">
            <h4 class="font-bold truncate text-content-light dark:text-content-dark">{{ item.name }}</h4>
            <p class="text-sm text-content-light/80 dark:text-content-dark/80">{{ item.category }}</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
EOF
}

# Función para crear un archivo de detalle básico
create_detail_file() {
    local file_path="$1"
    local title="$2"
    local item_name="$3"
    local go_back_text="$4"
    
    cat > "$file_path" << EOF
<div class="flex flex-col min-h-screen">
  <main class="flex-grow">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="max-w-4xl mx-auto">
        <!-- Loading State -->
        <div *ngIf="isLoading()" class="text-center py-8">
          <p class="text-text-light dark:text-text-dark">Cargando $item_name...</p>
        </div>

        <!-- Error State -->
        <div *ngIf="errorMessage()" class="text-center py-8 text-red-500">
          <p>{{ errorMessage() }}</p>
          <button (click)="goBack()" class="mt-4 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/80 transition-colors">
            $go_back_text
          </button>
        </div>

        <!-- Detail Content -->
        <div *ngIf="!isLoading() && !errorMessage() && item()">
          <div class="mb-6 text-sm text-content-light/60 dark:text-content-dark/60">
            <a class="hover:text-primary cursor-pointer" (click)="goBack()">$title</a>
            <span class="mx-2">/</span>
            <span class="text-content-light dark:text-content-dark">{{ item()?.category }}</span>
          </div>

          <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-12">
            <div class="flex-shrink-0 w-32 h-32 md:w-40 md:h-40 rounded-lg overflow-hidden shadow-lg bg-surface-light dark:bg-surface-dark">
              <img
                [src]="item()?.image"
                [alt]="item()?.name"
                class="w-full h-full object-contain p-2"
                loading="lazy"
              />
            </div>
            <div class="flex-grow">
              <h1 class="text-4xl font-bold text-content-light dark:text-content-dark mb-2">{{ item()?.name }}</h1>
              <p class="text-content-light/60 dark:text-content-dark/60">{{ item()?.description }}</p>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
              <h2 class="text-2xl font-bold mb-4 border-b-2 border-primary pb-2">Información</h2>
              <div class="grid grid-cols-2 gap-x-4 gap-y-4">
                <div class="flex flex-col">
                  <span class="text-sm text-content-light/60 dark:text-content-dark/60">Categoría</span>
                  <span class="font-medium text-content-light dark:text-content-dark">{{ item()?.category }}</span>
                </div>
              </div>
            </div>
            <div>
              <h2 class="text-2xl font-bold mb-4 border-b-2 border-primary pb-2">Descripción</h2>
              <p class="text-base leading-relaxed">
                {{ item()?.description }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
EOF
}

# Corregir archivos de lista
create_list_file "src/app/pages/armors/armors-list.component.html" "Armaduras" "Protege tu cuerpo con las mejores armaduras de las Tierras Intermedias." "armaduras" "goToArmorDetail"
create_list_file "src/app/pages/bosses/bosses-list.component.html" "Jefes" "Enfréntate a los temibles señores de las Tierras Intermedias." "jefes" "goToBossDetail"
create_list_file "src/app/pages/sorceries/sorceries-list.component.html" "Hechizos" "Domina las artes arcanas de las Tierras Intermedias." "hechizos" "goToSorceryDetail"
create_list_file "src/app/pages/items/items-list.component.html" "Items" "Explora los items de las Tierras Intermedias." "items" "goToItemDetail"
create_list_file "src/app/pages/ammos/ammos-list.component.html" "Municiones" "Explora las municiones de las Tierras Intermedias." "municiones" "goToAmmoDetail"
create_list_file "src/app/pages/ashes/ashes-list.component.html" "Cenizas" "Explora las cenizas de las Tierras Intermedias." "cenizas" "goToAshDetail"
create_list_file "src/app/pages/classes/classes-list.component.html" "Clases" "Explora las clases de las Tierras Intermedias." "clases" "goToClassDetail"
create_list_file "src/app/pages/creatures/creatures-list.component.html" "Criaturas" "Explora las criaturas de las Tierras Intermedias." "criaturas" "goToCreatureDetail"
create_list_file "src/app/pages/incantations/incantations-list.component.html" "Encantamientos" "Explora los encantamientos de las Tierras Intermedias." "encantamientos" "goToIncantationDetail"
create_list_file "src/app/pages/locations/locations-list.component.html" "Ubicaciones" "Explora las ubicaciones de las Tierras Intermedias." "ubicaciones" "goToLocationDetail"
create_list_file "src/app/pages/npcs/npcs-list.component.html" "NPCs" "Explora los NPCs de las Tierras Intermedias." "NPCs" "goToNpcDetail"
create_list_file "src/app/pages/shields/shields-list.component.html" "Escudos" "Explora los escudos de las Tierras Intermedias." "escudos" "goToShieldDetail"
create_list_file "src/app/pages/spirits/spirits-list.component.html" "Espíritus" "Explora los espíritus de las Tierras Intermedias." "espíritus" "goToSpiritDetail"
create_list_file "src/app/pages/talismans/talismans-list.component.html" "Talismanes" "Explora los talismanes de las Tierras Intermedias." "talismanes" "goToTalismanDetail"

# Corregir archivos de detalle
create_detail_file "src/app/pages/armors/armor-detail.component.html" "Armaduras" "armadura" "Volver a Armaduras"
create_detail_file "src/app/pages/bosses/boss-detail.component.html" "Jefes" "jefe" "Volver a Jefes"
create_detail_file "src/app/pages/sorceries/sorcery-detail.component.html" "Hechizos" "hechizo" "Volver a Hechizos"
create_detail_file "src/app/pages/items/items-detail.component.html" "Items" "item" "Volver a Items"
create_detail_file "src/app/pages/ammos/ammos-detail.component.html" "Municiones" "munición" "Volver a Municiones"
create_detail_file "src/app/pages/ashes/ashes-detail.component.html" "Cenizas" "ceniza" "Volver a Cenizas"
create_detail_file "src/app/pages/classes/classes-detail.component.html" "Clases" "clase" "Volver a Clases"
create_detail_file "src/app/pages/creatures/creatures-detail.component.html" "Criaturas" "criatura" "Volver a Criaturas"
create_detail_file "src/app/pages/incantations/incantations-detail.component.html" "Encantamientos" "encantamiento" "Volver a Encantamientos"
create_detail_file "src/app/pages/locations/locations-detail.component.html" "Ubicaciones" "ubicación" "Volver a Ubicaciones"
create_detail_file "src/app/pages/npcs/npcs-detail.component.html" "NPCs" "NPC" "Volver a NPCs"
create_detail_file "src/app/pages/shields/shields-detail.component.html" "Escudos" "escudo" "Volver a Escudos"
create_detail_file "src/app/pages/spirits/spirits-detail.component.html" "Espíritus" "espíritu" "Volver a Espíritus"
create_detail_file "src/app/pages/talismans/talismans-detail.component.html" "Talismanes" "talismán" "Volver a Talismanes"

echo "Todos los archivos han sido corregidos exitosamente."