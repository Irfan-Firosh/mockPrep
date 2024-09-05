<tr class="mt-4" style="margin: 20rem">
    <td scope="row">{{$job->title}}</td>
    <td>{{$job->company}}</td>
    <td>{{$job->locations}}</td>
    <td colspan="2"><a href="{{$job->url}}" target="on_blank" class="apply-button" 
        style="background-color:rgb(42, 10, 42) ;font-size: 1rem; font-weight: 500; padding: 7px 20px; border-radius: 0.75rem;
                white-space: nowrap; width: 150px; text-align:center; display:inline-block;">
        Apply <i class="fa-solid fa-link">
    </i></a></td>
</tr>