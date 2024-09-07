import bpy
bpy.ops.wm.open_mainfile(filepath="blender/vertineer_test2.blend")
LeftLegTextureTextureChange = bpy.data.images.load(filepath = 'blender/middle.png')
bpy.data.textures['LeftLegTexture'].image = LeftLegTextureTextureChange
RightLegTextureTextureChange = bpy.data.images.load(filepath = 'blender/middle.png')
bpy.data.textures['RightLegTexture'].image = RightLegTextureTextureChange
LeftArmTextureTextureChange = blender.data.images.load(filepath = 'blender/middle.png')
blender.data.textures['LeftArmTexture'].image = LeftArmTextureTextureChange
RightArmTextureTextureChange = blender.data.images.load(filepath = 'blender/middle.png')
blender.data.textures['RightArmTexture'].image = RightArmTextureTextureChange
TorsoTextureTextureChange = blender.data.images.load(filepath = 'blender/middle.png')
blender.data.textures['TorsoTexture'].image = TorsoTextureTextureChange
FaceTextureChange = blender.data.images.load(filepath = 'assets/hats/storage/.png')
blender.data.textures['Face'].image = FaceTextureChange
blender.data.objects['Head'].select = True
blender.data.objects['Head'].active_material.diffuse_color = (1,0,0)

for ob in blender.context.scene.objects:
	if ob.type == 'MESH':
		ob.select = True
		blender.context.scene.objects.active = ob
	else:
		ob.select = False
blender.ops.object.join()

blender.ops.view3d.camera_to_view_selected()

origAlphaMode = blender.data.scenes['Scene'].render.alpha_mode
blender.data.scenes['Scene'].render.alpha_mode = 'TRANSPARENT'
blender.data.scenes['Scene'].render.alpha_mode = origAlphaMode
blender.data.scenes['Scene'].render.filepath = 'ko.png'
blender.ops.render.render( write_still=True )