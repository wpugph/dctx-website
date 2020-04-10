<?php
/**
 * The template used for displaying typography in the scaffolding library.
 *
 * @package dctx
 */

?>

<section class="section-scaffolding">

	<h2 class="scaffolding-heading"><?php esc_html_e( 'Typography', 'dctx' ); ?></h2>

	<?php
	// H1.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'H1',
			'description' => 'Display an H1',
			'usage'       => '<h1>This is a headline</h1> or <div class="h1">This is a headline</div>',
			'output'      => '<h1>This is a headline one</h1>',
		)
	);

	// H2.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'H2',
			'description' => 'Display an H2',
			'usage'       => '<h2>This is a headline</h2> or <div class="h2">This is a headline</div>',
			'output'      => '<h2>This is a headline two</h2>',
		)
	);

	// H3.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'H3',
			'description' => 'Display an H3',
			'usage'       => '<h3>This is a headline</h3> or <div class="h3">This is a headline</div>',
			'output'      => '<h3>This is a headline three</h3>',
		)
	);

	// H4.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'H4',
			'description' => 'Display an H4',
			'usage'       => '<h4>This is a headline</h4> or <div class="h4">This is a headline</div>',
			'output'      => '<h4>This is a headline four</h4>',
		)
	);

	// H5.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'H5',
			'description' => 'Display an H5',
			'usage'       => '<h5>This is a headline</h5> or <div class="h5">This is a headline</div>',
			'output'      => '<h5>This is a headline five</h5>',
		)
	);

	// H6.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'H6',
			'description' => 'Display an H6',
			'usage'       => '<h6>This is a headline</h6> or <div class="h6">This is a headline</div>',
			'output'      => '<h6>This is a headline six</h6>',
		)
	);

	// Body.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Paragraph',
			'description' => 'Display a paragraph',
			'usage'       => '<p>Elementum faucibus vehicula id neque magnis scelerisque quam conubia torquent, auctor nisl quis aliquet venenatis sem sagittis morbi eu, fermentum ipsum congue ultrices non dui lectus pulvinar. Sapien etiam convallis urna suscipit euismod pharetra tellus himenaeos, dignissim consectetur cum suspendisse sem ornare eros enim egestas, cubilia venenatis mauris vivamus elit fringilla duis.</p>',
			'output'      => '<p>Elementum faucibus vehicula id neque magnis scelerisque quam conubia torquent, auctor nisl quis aliquet venenatis sem sagittis morbi eu, fermentum ipsum congue ultrices non dui lectus pulvinar. Sapien etiam convallis urna suscipit euismod pharetra tellus himenaeos, dignissim consectetur cum suspendisse sem ornare eros enim egestas, cubilia venenatis mauris vivamus elit fringilla duis.</p>',
		)
	);

	// Link.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Link',
			'description' => 'Displays a link.',
			'usage'       => '<a href="#">Link</a>',
			'output'      => '<a href="#">Link</a>',
		)
	);

	// HTML table.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Table',
			'description' => 'Display a table',
			'usage'       => '
				<table title="A simple data table" aria-label="A simple data table">
					<thead>
						<tr>
							<th scope="col">Table Header 1</th>
							<th scope="col">Table Header 2</th>
							<th scope="col">Table Header 3</th>
							<th scope="col">Table Header 4</th>
							<th scope="col">Table Header 5</th>
							<th scope="col">Table Header 6</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Division 1</td>
							<td>Division 2</td>
							<td>Division 3</td>
							<td>Division 4</td>
							<td>Division 5</td>
							<td>Division 6</td>
						</tr>
						<tr>
							<td>Division 1</td>
							<td>Division 2</td>
							<td>Division 3</td>
							<td>Division 4</td>
							<td>Division 5</td>
							<td>Division 6</td>
						</tr>
						<tr>
							<td>Division 1</td>
							<td>Division 2</td>
							<td>Division 3</td>
							<td>Division 4</td>
							<td>Division 5</td>
							<td>Division 6</td>
						</tr>
					</tbody>
				</table>
			',
			'output'      => '
				<table title="A simple data table" aria-label="A simple data table">
					<thead>
						<tr>
							<th scope="col">Table Header 1</th>
							<th scope="col">Table Header 2</th>
							<th scope="col">Table Header 3</th>
							<th scope="col">Table Header 4</th>
							<th scope="col">Table Header 5</th>
							<th scope="col">Table Header 6</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Division 1</td>
							<td>Division 2</td>
							<td>Division 3</td>
							<td>Division 4</td>
							<td>Division 5</td>
							<td>Division 6</td>
						</tr>
						<tr>
							<td>Division 1</td>
							<td>Division 2</td>
							<td>Division 3</td>
							<td>Division 4</td>
							<td>Division 5</td>
							<td>Division 6</td>
						</tr>
						<tr>
							<td>Division 1</td>
							<td>Division 2</td>
							<td>Division 3</td>
							<td>Division 4</td>
							<td>Division 5</td>
							<td>Division 6</td>
						</tr>
					</tbody>
				</table>
			',
		)
	);


	// Ordered List.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Ordered List',
			'description' => 'Display an ordered list.',
			'usage'       => '
				<ol>
					<li>ordered item</li>
					<li>ordered item
						<ul>
							<li><strong>unordered</strong></li>
							<li><strong>unordered</strong>
								<ol>
									<li>ordered item</li>
									<li>ordered item</li>
								</ol>
							</li>
						</ul>
					</li>
					<li>ordered item</li>
					<li>ordered item</li>
				</ol>
			',
			'output'      => '
				<ol>
					<li>ordered item</li>
					<li>ordered item
						<ul>
							<li><strong>unordered</strong></li>
							<li><strong>unordered</strong>
								<ol>
									<li>ordered item</li>
									<li>ordered item</li>
								</ol>
							</li>
						</ul>
					</li>
					<li>ordered item</li>
					<li>ordered item</li>
				</ol>
			',
		)
	);

	// Unordered List.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Unordered List',
			'description' => 'Display an unordered list.',
			'usage'       => '
				<ul>
					<li>unordered item</li>
					<li>unordered item
						<ul>
							<li>unordered</li>
							<li>unordered
								<ol>
									<li><strong>ordered item</strong></li>
									<li><strong>ordered item</strong></li>
								</ol>
							</li>
						</ul>
					</li>
					<li>unordered item</li>
					<li>unordered item</li>
				</ul>
			',
			'output'      => '
				<ul>
					<li>unordered item</li>
					<li>unordered item
						<ul>
							<li>unordered</li>
							<li>unordered
								<ol>
									<li><strong>ordered item</strong></li>
									<li><strong>ordered item</strong></li>
								</ol>
							</li>
						</ul>
					</li>
					<li>unordered item</li>
					<li>unordered item</li>
				</ul>
			',
		)
	);

	// Blockquote.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Blockquote',
			'description' => 'Display a blockquote.',
			'usage'       => '<blockquote><p>Stay hungry. Stay foolish.</p></blockquote>',
			'output'      => '<blockquote><p>Stay hungry. Stay foolish.</p></blockquote>',
		)
	);

	// Code tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Code Tag',
			'description' => 'Display a code tag.',
			'usage'       => '<code>word-wrap: break-word;</code>',
			'output'      => '<p>You will learn later on in these tests that <code>word-wrap: break-word;</code> will be your best friend.</p>',
		)
	);

	// Em tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Emphasize Tag',
			'description' => 'Display an <em> tag.',
			'usage'       => '<em>italicize</em>',
			'output'      => 'The emphasize tag should <em>italicize</em> text.',
		)
	);

	// Strong tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Strong Tag',
			'description' => 'Display bold text.',
			'usage'       => '<strong>bold<strong>',
			'output'      => '<p>This tag shows <strong>bold<strong> text.</strong></strong></p>',
		)
	);

	// Abbreviation Tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Abbreviation Tag',
			'description' => 'Display an abbreviation.',
			'usage'       => '<abbr title="Seriously">srsly</abbr>',
			'output'      => '<p>The abbreviation <abbr title="Seriously">srsly</abbr> stands for "seriously".</p>',
		)
	);

	// Cite Tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Cite Tag',
			'description' => 'Display a citation.',
			'usage'       => '<cite>Automattic</cite>',
			'output'      => '<p>"Code is poetry." &mdash;<cite>Automattic</cite></p>',
		)
	);

	// Strikeout Tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Strikeout Text',
			'description' => 'Display strikeout text.',
			'usage'       => '<s>strikeout text</s>',
			'output'      => '<p>This tag will let you <s>strikeout text</s>.</p>',
		)
	);

	// Delete Tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Delete Text',
			'description' => 'Display the edited content of a text string.',
			'usage'       => '<del>dctx</del>',
			'output'      => '<p>We use <del>dctx</del> wd_s to build themes.</p>',
		)
	);

	// Preformatted Tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Preformatted tag.',
			'description' => 'This tag styles large blocks of code.',
			'usage'       => '
				<pre>.post-title {
					margin: 0 0 5px;
					font-weight: bold;
					font-size: 38px;
					line-height: 1.2;
				}</pre>
			',
			'output'      => '
				<pre>.post-title {
					margin: 0 0 5px;
					font-weight: bold;
					font-size: 38px;
					line-height: 1.2;
				}</pre>
			',
		)
	);

	// Keyboard Tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Keyboard Tag',
			'description' => 'To display a key.',
			'usage'       => '<kbd>Shift/kbd>',
			'output'      => '<p>To paste copied text content stripped of formatting, use <kbd>&#8984;</kbd>+<kbd>Opt</kbd>+<kbd>Shift</kbd>+<kbd>V</kbd>.</p>',
		)
	);

	// Subscript Tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Subscript Tag',
			'description' => 'To display a subscript.',
			'usage'       => '<sub>2</sub>',
			'output'      => '<p>Getting our science styling on with H<sub>2</sub>O, which should push the "2" down.</p>',
		)
	);

	// Superscript Tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Superscript Tag',
			'description' => 'To display a superscript.',
			'usage'       => '<sup>2</sup>',
			'output'      => '<p>Still sticking with science and Albert Einstein\'s&nbsp;E = MC<sup>2</sup>, which should lift the "2" up.</p>',
		)
	);

	// Variable Tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Variable Tag',
			'description' => 'The HTML Variable element (<var>) represents the name of a variable in a mathematical expression or a programming context.',
			'usage'       => '<var>x</var>',
			'output'      => '<p>A simple equation: <var>x</var> = <var>y</var> + 2 </p>',
		)
	);

	// Address Tag.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Address Tag',
			'description' => 'To display an address.',
			'usage'       => '
				<address>
					1 Infinite Loop<br>
					Cupertino, CA 95014<br>
					United States
				</address>
			',
			'output'      => '
				<address>
					1 Infinite Loop<br>
					Cupertino, CA 95014<br>
					United States
				</address>
			',
		)
	);

	// Definition lists.
	dctx_display_scaffolding_section(
		array(
			'title'       => 'Definition Lists',
			'description' => 'To display defintion lists.',
			'usage'       => '
				<dl>
					<dt>Definition List Title</dt>
					<dd>Definition list division.</dd>
					<dt>Startup</dt>
					<dd>A startup company or startup is a company or temporary organization designed to search for a repeatable and scalable business model.</dd>
					<dt>#dowork</dt>
					<dd>Coined by Rob Dyrdek and his personal body guard Christopher "Big Black" Boykins, "Do Work" works as a self motivator, to motivating your friends.</dd>
				</dl>
			',
			'output'      => '
				<dl>
					<dt>Definition List Title</dt>
					<dd>Definition list division.</dd>
					<dt>Startup</dt>
					<dd>A startup company or startup is a company or temporary organization designed to search for a repeatable and scalable business model.</dd>
					<dt>#dowork</dt>
					<dd>Coined by Rob Dyrdek and his personal body guard Christopher "Big Black" Boykins, "Do Work" works as a self motivator, to motivating your friends.</dd>
				</dl>
			',
		)
	);
	?>
</section>
