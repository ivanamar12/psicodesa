const selectEstado = document.getElementById("selectEstado");
const selectMunicipio = document.getElementById('selectMunicipio')
const selectParroquia = document.getElementById('selectParroquia')

const showMunicipios = (filteredMunicipios)=> {
	selectMunicipio.innerHTML = '<option value="0">Municipio</option>';

	filteredMunicipios.forEach(item => {
		const option = document.createElement("OPTION")
		option.value = item.id
		option.text = item.municipio 
		selectMunicipio.appendChild(option)	
	})
}

const filterMunicipios = id => {
	const filteredMunicipios = municipios.filter(item => item.estado_id == id)
	showMunicipios(filteredMunicipios)
}

selectEstado.addEventListener('change', e => {
  filterMunicipios(e.target.value)
})

const showParroquias = (filteredParroquias)=> {
	selectParroquia.innerHTML = '<option value="0">Parroquia</option>';

	filteredParroquias.forEach(item => {
		const option = document.createElement("OPTION")
		option.value = item.id
		option.text = item.parroquia 
		selectParroquia.appendChild(option)	
	})
}

const filterParroquias = id => {
	const filteredParroquias = parroquias.filter(item => item.mmunicipio_id == id)
	showParroquias(filteredParroquias)
}

selectMunicipio.addEventListener('change', e => {
  filterParroquias(e.target.value)
})