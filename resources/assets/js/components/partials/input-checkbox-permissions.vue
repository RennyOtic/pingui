<template>
	<div class="row">
		<template v-for="(module, keym, indexm) in modules">
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-header"><b>{{ module }}.</b></div>
					<div class="box-body" style="font-size: 16px;">
						<table class="table table-condensed table-hover">
							<tbody>
								<tr class="form-inline"
									v-for="(p, key, index) in permissions"
									v-if="p.module == keym">
									<td :for="'perm' + p.id" style="font-size:13px;">
										<label :for="'perm' + p.id" class="control-label" style="color:black;font-size:13px;">
											{{ p.name }}:
										</label>
									</td>
									<td>
										<input :id="'perm' + p.id" style="margin: 9px 0 0 5px" type="checkbox" :value="p.id" v-model="permissionsRol" @change="update" :rs="p.action">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</template>
		<pre v-show="false">{{user}}</pre>
	</div>
</template>

<script>
export default {
	name: 'checkbox-permissions',
	props: ['user'],
	data () {
		return {
			permissionsRol: this.user,
			permissions: [],
			modules: {
				'rol': 'Roles',
				'permission': 'Permisos',
				'user': 'Usuarios',
				'club': 'Clubs',
				'referee': 'Referees',
				'categories_l': 'Categorias Latino',
				'categories_o': 'Categorias Opens',
				'categories_s': 'Categorias Standar',
				'tournament': 'Torneos',
				'organizer': 'Organizadores',
				'inscription': 'Inscripciones',
			},
		};
	},
	updated: function () {
		this.permissionsRol = this.user;
	},
	mounted: function () {
		axios.post('/admin/get-data-roles')
		.then(response => {
			this.permissions = response.data.permissions;
		});
	},
	methods: {
		update: function () {
			this.$emit('check', this.permissionsRol);
		}
	}
}
</script>
