<div class="modal fade" id="reason">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="ion ion-ios-paperplane-outline"></i> {{ trans('deployments.label') }}</h4>
            </div>
            <form role="form" method="post" action="{{ route('projects.deploy', ['id' => $project->id]) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="project_id" value="{{ $project->id }}" />
                <div class="modal-body">

                    <div class="callout callout-danger">
                        <i class="icon ion ion-alert"></i> {{ trans('deployments.warning') }}
                    </div>

                    @if ($project->allow_other_branch && (count($branches) || count($tags)))
                    <div class="form-group">
                        <label for="deployment_source">{{ trans('deployments.source') }}</label>
                        <ul class="list-unstyled">
                            <li>
                                <div class="radio">
                                    <label for="deployment_source_default">
                                        <input type="radio" class="deployment-source" name="source" id="deployment_source_default" value="{{ $project->branch }}" checked /> {{ trans('deployments.default', [ 'branch' => $project->branch ]) }}
                                    </label>
                                </div>
                            </li>

                            @if (count($branches))
                            <li>
                                <div class="radio">
                                    <label for="deployment_source_branch">
                                        <input type="radio" class="deployment-source" name="source" id="deployment_source_branch" value="branch" /> {{ trans('deployments.different_branch') }}

                                        <div class="deployment-source-container">
                                            <select class="form-control deployment-source" name="source_branch" id="deployment_branch">
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch }}">{{ $branch }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </label>
                                </div>
                            </li>
                            @endif

                            @if (count($tags))
                            <li>
                                <div class="radio">
                                    <label for="deployment_source_tag">
                                        <input type="radio" class="deployment-source" name="source" id="deployment_source_tag" value="tag" /> {{ trans('deployments.tag') }}

                                        <div class="deployment-source-container">
                                            <select class="form-control deployment-source" name="source_tag" id="deployment_tag">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag }}">{{ $tag }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </label>
                                </div>
                            </li>
                            @endif
                            <li>
                                <div class="radio">
                                    <label for="deployment_source_commit">
                                        <input type="radio" class="deployment-source" name="source" id="deployment_source_commit" value="commit" /> {{ trans('deployments.commit') }}

                                        <div class="deployment-source-container">
                                            <input class="form-control deployment-source" name="source_commit" id="deployment_commit" placeholder="{{ trans('deployments.describe_commit') }}">
                                        </div>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <hr />
                    @endif
                    <div class="form-group">
                        <label for="deployment_reason">{{ trans('deployments.reason') }}</label>
                        <textarea rows="5" id="deployment_reason" class="form-control" name="reason" placeholder="{{ trans('deployments.describe_reason') }}"></textarea>
                    </div>
                    @if (count($optional))
                    <div class="form-group">
                        <label for="command_servers">{{ trans('deployments.optional') }}</label>
                        <ul class="list-unstyled">
                            @foreach ($optional as $command)
                            <li>
                                <div class="checkbox">
                                    <label for="deployment_command_{{ $command->id }}">
                                        <input type="checkbox" class="deployment-command" name="optional[]" id="deployment_command_{{ $command->id }}" value="{{ $command->id }}" @if ($command->default_on === true) checked @endif/> {{ $command->name }}
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary pull-left btn-save">{{ trans('projects.deploy') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
