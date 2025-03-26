export interface Categorie {
  // columns
  id: number
  name: string
  created_at: string | null
  updated_at: string | null
  // relations
  depense: Depense[]
}

export interface Depense {
  // columns
  id: number
  titre: string
  description: string | null
  montant: number
  src: string | null
  date: string
  categorie_id: number
  created_at: string | null
  updated_at: string | null
  // relations
  categorie: Categorie
}
