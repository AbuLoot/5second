
            <div class="row no-gutters">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="custom-select-form">
                    <select class="wide add_bottom_10" name="country" id="country">
                      <option value="" selected>Регион*</option>
                      <?php $traverse = function ($nodes, $prefix = null) use (&$traverse) { ?>
                        <?php foreach ($nodes as $node) : ?>
                          <option value="{{ $node->id }}">{{ PHP_EOL.$prefix.' '.$node->title }}</option>
                          <?php $traverse($node->children, $prefix.'___'); ?>
                        <?php endforeach; ?>
                      <?php }; ?>
                      <?php $traverse($regions); ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>