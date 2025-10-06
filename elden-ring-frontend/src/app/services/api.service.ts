import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/internal/Observable';
import { map } from 'rxjs/operators';

interface ApiResponse<T> {
  success: boolean;
  count: number;
  data: T[];
}

export interface ApiSingleResponse<T> {
  success: boolean;
  data: T;
}

export interface Location {
  id: string;
  name: string;
  image: string;
  region: string;
  description: string;
}

export interface Weapon {
  id: string;
  name: string;
  image: string;
  description: string;
  attack: { name: string; amount: number }[];
  defence: { name: string; amount: number }[];
  scalesWith: { name: string; scaling: string }[];
  requiredAttributes: { name: string; amount: number }[];
  category: string;
  weight: number;
}

export interface Boss {
  id: string;
  name: string;
  image: string | null;
  region: string;
  description: string;
  location: string;
  drops: string[];
  healthPoints: string;
}

export interface Item {
  id: string;
  name: string;
  image: string;
  description: string;
  type: string;
  effect: string;
}

export interface Ammo {
  id: string;
  name: string;
  image: string;
  description: string;
  type: string;
  attackPower: { name: string; amount: number | null }[];
  passive: string;
}

export interface Armor {
  id: string;
  name: string;
  image: string;
  description: string;
  category: string;
  weight: number;
  dmgNegation: { name: string; amount: number }[];
  resistance: { name: string; amount: number }[];
}

export interface Ash {
  id: string;
  name: string;
  image: string;
  description: string;
  affinity: string;
  skill: string;
}

export interface Class {
  id: string;
  name: string;
  image: string;
  description: string;
  stats: {
    level: string;
    vigor: string;
    mind: string;
    endurance: string;
    strength: string;
    dexterity: string;
    intelligence: string;
    faith: string;
    arcane: string;
  };
}

export interface Creature {
  id: string;
  name: string;
  image: string;
  description: string;
  location: string;
  drops: string[];
}

export interface Incantation {
  id: string;
  name: string;
  image: string;
  description: string;
  type: string;
  cost: number;
  slots: number;
  effects: string;
  requires: { name: string; amount: number }[];
}

export interface Npc {
  id: string;
  name: string;
  image: string;
  quote: string | null;
  location: string;
  role: string;
}

export interface Shield {
  id: string;
  name: string;
  image: string;
  description: string;
  attack: { name: string; amount: number }[];
  defence: { name: string; amount: number }[];
  scalesWith: { name: string; scaling: string }[];
  requiredAttributes: { name: string; amount: number }[];
  category: string;
  weight: number;
}

export interface Sorcery {
  id: string;
  name: string;
  image: string;
  description: string;
  type: string;
  cost: number;
  slots: number;
  effects: string;
  requires: { name: string; amount: number }[];
}

export interface Spirit {
  id: string;
  name: string;
  image: string;
  description: string;
  fpCost: string;
  hpCost: string;
  effect: string;
}

export interface Talisman {
  id: string;
  name: string;
  image: string;
  description: string;
  effect: string;
}

export interface SearchableItem {
  id: number;
  name: string;
  image: string;
  description: string;
  type: string;
  region?: string | null;
  extra_data?: any;
  created_at?: string;
  updated_at?: string;
}

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  private apiUrl = 'http://localhost:8080/api';

  constructor(private http: HttpClient) {}

  getUniqueRegions(): Observable<string[]> {
    return this.getLocations().pipe(
      map((response) => {
        const allRegions = response.data.map(
          (location: any) => location.region,
        );

        return [...new Set(allRegions)].filter((region) => region).sort();
      }),
    );
  }

  getRegionData(regionName: string): Observable<any> {
    return this.http.get(`${this.apiUrl}/regions/${regionName}`);
  }

  getWeapons(): Observable<ApiResponse<Weapon>> {
    return this.http.get<ApiResponse<Weapon>>(`${this.apiUrl}/weapons`);
  }

  // New method to get weapon by ID
  getWeaponById(id: string): Observable<ApiSingleResponse<Weapon>> {
    return this.http.get<ApiSingleResponse<Weapon>>(
      `${this.apiUrl}/weapons/${id}`,
    );
  }

  // Bosses
  getBosses(): Observable<ApiResponse<Boss>> {
    return this.http.get<ApiResponse<Boss>>(`${this.apiUrl}/bosses`);
  }

  getBossById(id: string): Observable<ApiSingleResponse<Boss>> {
    return this.http.get<ApiSingleResponse<Boss>>(
      `${this.apiUrl}/bosses/${id}`,
    );
  }

  // Items
  getItems(): Observable<ApiResponse<Item>> {
    return this.http.get<ApiResponse<Item>>(`${this.apiUrl}/items`);
  }

  getItemById(id: string): Observable<ApiSingleResponse<Item>> {
    return this.http.get<ApiSingleResponse<Item>>(`${this.apiUrl}/items/${id}`);
  }

  // Ammos
  getAmmos(): Observable<ApiResponse<Ammo>> {
    return this.http.get<ApiResponse<Ammo>>(`${this.apiUrl}/ammos`);
  }

  getAmmoById(id: string): Observable<ApiSingleResponse<Ammo>> {
    return this.http.get<ApiSingleResponse<Ammo>>(`${this.apiUrl}/ammos/${id}`);
  }

  // Armors
  getArmors(): Observable<ApiResponse<Armor>> {
    return this.http.get<ApiResponse<Armor>>(`${this.apiUrl}/armors`);
  }

  getArmorById(id: string): Observable<ApiSingleResponse<Armor>> {
    return this.http.get<ApiSingleResponse<Armor>>(
      `${this.apiUrl}/armors/${id}`,
    );
  }

  // Ashes
  getAshes(): Observable<ApiResponse<Ash>> {
    return this.http.get<ApiResponse<Ash>>(`${this.apiUrl}/ashes`);
  }

  getAshById(id: string): Observable<ApiSingleResponse<Ash>> {
    return this.http.get<ApiSingleResponse<Ash>>(`${this.apiUrl}/ashes/${id}`);
  }

  // Classes
  getClasses(): Observable<ApiResponse<Class>> {
    return this.http.get<ApiResponse<Class>>(`${this.apiUrl}/classes`);
  }

  getClassById(id: string): Observable<ApiSingleResponse<Class>> {
    return this.http.get<ApiSingleResponse<Class>>(
      `${this.apiUrl}/classes/${id}`,
    );
  }

  // Creatures
  getCreatures(): Observable<ApiResponse<Creature>> {
    return this.http.get<ApiResponse<Creature>>(`${this.apiUrl}/creatures`);
  }

  getCreatureById(id: string): Observable<ApiSingleResponse<Creature>> {
    return this.http.get<ApiSingleResponse<Creature>>(
      `${this.apiUrl}/creatures/${id}`,
    );
  }

  // Incantations
  getIncantations(): Observable<ApiResponse<Incantation>> {
    return this.http.get<ApiResponse<Incantation>>(
      `${this.apiUrl}/incantations`,
    );
  }

  getIncantationById(id: string): Observable<ApiSingleResponse<Incantation>> {
    return this.http.get<ApiSingleResponse<Incantation>>(
      `${this.apiUrl}/incantations/${id}`,
    );
  }

  // Locations
  getLocations(): Observable<ApiResponse<Location>> {
    return this.http.get<ApiResponse<Location>>(`${this.apiUrl}/locations`);
  }

  getLocationById(id: string): Observable<ApiSingleResponse<Location>> {
    return this.http.get<ApiSingleResponse<Location>>(
      `${this.apiUrl}/locations/${id}`,
    );
  }

  // NPCs
  getNpcs(): Observable<ApiResponse<Npc>> {
    return this.http.get<ApiResponse<Npc>>(`${this.apiUrl}/npcs`);
  }

  getNpcById(id: string): Observable<ApiSingleResponse<Npc>> {
    return this.http.get<ApiSingleResponse<Npc>>(`${this.apiUrl}/npcs/${id}`);
  }

  // Shields
  getShields(): Observable<ApiResponse<Shield>> {
    return this.http.get<ApiResponse<Shield>>(`${this.apiUrl}/shields`);
  }

  getShieldById(id: string): Observable<ApiSingleResponse<Shield>> {
    return this.http.get<ApiSingleResponse<Shield>>(
      `${this.apiUrl}/shields/${id}`,
    );
  }

  // Sorceries
  getSorceries(): Observable<ApiResponse<Sorcery>> {
    return this.http.get<ApiResponse<Sorcery>>(`${this.apiUrl}/sorceries`);
  }

  getSorceryById(id: string): Observable<ApiSingleResponse<Sorcery>> {
    return this.http.get<ApiSingleResponse<Sorcery>>(
      `${this.apiUrl}/sorceries/${id}`,
    );
  }

  // Spirits
  getSpirits(): Observable<ApiResponse<Spirit>> {
    return this.http.get<ApiResponse<Spirit>>(`${this.apiUrl}/spirits`);
  }

  getSpiritById(id: string): Observable<ApiSingleResponse<Spirit>> {
    return this.http.get<ApiSingleResponse<Spirit>>(
      `${this.apiUrl}/spirits/${id}`,
    );
  }

  // Talismans
  getTalismans(): Observable<ApiResponse<Talisman>> {
    return this.http.get<ApiResponse<Talisman>>(`${this.apiUrl}/talismans`);
  }

  getTalismanById(id: string): Observable<ApiSingleResponse<Talisman>> {
    return this.http.get<ApiSingleResponse<Talisman>>(
      `${this.apiUrl}/talismans/${id}`,
    );
  }

  // Search
  search(query: string): Observable<SearchableItem[]> {
    return this.http.get<SearchableItem[]>(`${this.apiUrl}/search?q=${encodeURIComponent(query)}`);
  }
}
