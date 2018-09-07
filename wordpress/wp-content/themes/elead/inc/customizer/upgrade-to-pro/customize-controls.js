( function( api ) {

	// Extends our custom "elead" section.
	api.sectionConstructor['elead'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
