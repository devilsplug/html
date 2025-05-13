(self.webpackChunk=self.webpackChunk||[]).push([[170],{5748:()=>{function r(s=1){let e=$("#member-rank :selected").val();$.getJSON(`/api/clans/members/${$('meta[name="clan_id"]').attr("content")}/${e}/${s}/12`,t=>{let i="";for(let n in t.data){let c=t.data[n].user,d="";$("#member-rank option").each(function(){($(this).val()<100||e==100)&&(d+=`<option value=${$(this).val()} ${$(this).val()==e?"selected":""}>${new Option($(this).text()).innerHTML}</option>`)}),i+=`<div class="edit-member inline center-text" style="position:relative;">
                        <a href="/user/${c.id}/">
                            <div class="clan-member ellipsis">
                                <img src="${BH.avatarImg(c.avatar_hash)}" style="width:115px;height:115px;">
                                <div class="ellipsis">${new Option(c.username).innerHTML}</div>
                            </div>
                        </a>
                        ${t.data[n].rank!=100?`<form method="POST" action="https://www.brick-hill.com/clan/edit">
                            <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr("content")}">
                            <input type="hidden" name="type" value="kick_user">
                            <input type="hidden" name="clan_id" value="${$('meta[name="clan_id"]').attr("content")}">
                            <input type="hidden" name="user_id" value="${c.id}">
                            <i class="fas fa-ban" style="position:absolute;top:12px;left:12px;cursor:pointer;" title="Kick" onclick="$(this).parent().submit()"></i>
                        </form>`:""}
                        <div style="width:120px;padding-left:12px;">
                            <select class='select edit-member-select' name="value" ${t.data[n].rank==100?"disabled":""} data-user="${c.id}">
                                ${d}
                            </select>
                        </div>
                    </div>`}let l="";for(let n of t.pages.pages)l+=`<a class="page${n==s?" active":""}" onclick="loadEditMembers(${n})">${n}</a>`;$(".member-pages").html(l),$(".edit-holder").html(i)})}function o(s){if($(s.target).hasClass("forum-create-button")||s.keyCode==13){let e=$("#clan-search-bar").val();if(e=="")return $(".relation-holder").html("");$.getJSON(`/api/clans/relations/${$('meta[name="clan_id"]').attr("content")}/${e}/`,t=>{let i="";if(t.data.length==0)return $(".relation-holder").html("No clans found");for(let l in t.data){let n=t.data[l];i+=`<div class="clan-relation" style="padding:5px;position:relative;">
                            <a href="/clan/${n.id}/">
                                <img src="${BH.storage_domain}/images/clans/${n.thumbnail}.png" style="width:75px;height:75px;">
                                <span class="clan-name ellipsis">${new Option(n.title).innerHTML}</span>
                            </a>
                            <form method="POST" action="https://www.brick-hill.com/clan/edit" class="clan-form">
                                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr("content")}">
                                <input type="hidden" name="type" value="new_relation">
                                <input type="hidden" name="clan_id" value="${$('meta[name="clan_id"]').attr("content")}">
                                <input type="hidden" name="to_id" value="${n.id}">
                                <input class="button small smaller-text mr1 green upload-submit" type="submit" value="ALLY" name="ally">
                                <input class="button small smaller-text red upload-submit" type="submit" value="ENEMY" name="enemy">
                            </form>
                        </div>`}$(".relation-holder").html(i)})}}window.loadEditMembers=r,window.searchRelationClans=o},9138:()=>{function r(o,t){var e,t=t||200;return function(){var i=this,l=arguments;clearTimeout(e),e=setTimeout(function(){o.apply(i,Array.prototype.slice.call(l))},t)}}$(document).ready(()=>{$(".tabs .tab").on("click",o=>{let s=$(o.target),e=$(".tabs .tab.active"),t=s.data("tab"),i=$(".tab-holder .tab-body.active"),l=$(`.tab-holder .tab-body[data-tab="${t}"]`);e.removeClass("active"),s.addClass("active"),i.removeClass("active"),l.addClass("active")}),$(".tab-buttons .tab-button").on("click",o=>{let s=$(".tab-buttons .tab-button.blue"),e=$(o.target);s.removeClass("blue").addClass("transparent"),e.addClass("blue").removeClass("transparent"),$(".button-tab.active").removeClass("active"),$('.button-tab[data-tab="'+e.data("tab")+'"]').addClass("active")});try{window.location.hash&&$(`.tabs .tab${window.location.hash}`).length>0&&$(`.tabs .tab${window.location.hash}`).click()}catch(o){}}),window.debouncer=r},3880:()=>{function r(e="all",t="updated",i="",l="",n=!1){let c=$("#item-holder");$.getJSON(BH.apiUrl(`v1/shop/list?sort=${t}&type=${e}&search=${i}&cursor=${l}&limit=20`)).then(d=>{nextCursor=d.next_cursor,n&&(shopEnd=!1,c.html("")),d.next_cursor||(shopEnd=!0);for(let p=0;p<d.data.length;p++){let a=d.data[p],h=`
			<div class="col-1-4 mobile-col-1-2 mobile-half-fill" style="padding-right:20px;">
				<div class="card">
					<a href="/shop/${a.id}/">
						<div class="thumbnail dark" style="position:relative;${a.special_edition||a.special?"border:5px solid #FFD52D;border-bottom:0;padding:15px 15px 20px;":"padding:20px;"}">
							${a.special?'<span class="special-icon"></span>':""}
							${a.special_edition?'<span class="special-e-icon"></span>':""}
							<img src="${a.thumbnail}">
						</div>
					</a>
					<div class="item-content">
						<a href="/shop/${a.id}/" style="color:#000;">
							<span class="name">${new Option(a.name).innerHTML}</span>
						</a>
						<div class="creator">
							By
							<a href="/user/${a.creator.id}/">${new Option(a.creator.username).innerHTML}</a>
						</div>
						<div class="price">
							${a.stock_left<=0?'<span class="offsale-text">Sold Out</span>':`
							${a.special?'<span class="offsale-text">Offsale</span>':`
							${a.bucks==0||a.bits==0?'<span class="offsale-text">Free</span>':""}
							${a.bucks===null&&a.bits===null?'<span class="offsale-text">Offsale</span>':""}
							${a.bucks?'<span class="bucks-text"><span class="bucks-icon"></span> '+a.bucks+"</span>":""}
							${a.bucks&&a.bits?'<div style="width:5px;display:inline-block;"></div>':""}
							${a.bits?'<span class="bits-text"><span class="bits-icon"></span> '+a.bits+"</span>":""}
							`}
							`}
						</div>
					</div>
				</div>
			</div>
			`;c.append(h)}document.body.scrollHeight==$(window).height()&&!shopEnd&&r($(".shop-categories .active a").data("itemType"),$("#shopSort :selected").data("sort"),currentSearch,d.next_cursor)})}function o(e){$.post("/shop/favorite",{_token:$('meta[name="csrf-token"]').attr("content"),item_id:e},t=>{if(t.success){let i=$(".item-favorite i"),l=$(".item-favorite span");l.text(parseInt(l.text())-(i.hasClass("fas")?1:-1)),$(".item-favorite i").toggleClass("fas").toggleClass("far")}},"json")}$(document).on("click","#search",s),$(document).on("keyup","#search-bar",s),$(document).on("change","#shopSort",()=>{s(!0)}),$(document).on("click",".shop-categories .category",e=>{let t=$(e.target);$(".shop-categories .category.active").removeClass("active"),t.closest(".category").addClass("active"),s(!0)}),window.nextCursor="",window.shopEnd=!1,window.currentSearch="";function s(e){if(e===!0||$(e.target).attr("id")=="search"||e.keyCode==13){let i=$("#search-bar").val(),l=$(".shop-categories .active a").data("itemType"),n=$("#shopSort :selected").data("sort");currentSearch=i,(window.location.pathname!=="/shop"||window.location.pathname!=="/shop/")&&(window.history.pushState("shop","Shop","/shop/"),document.title="Shop - Brick Hill",$(".col-10-12.push-1-12.item-holder").remove(),$(".col-10-12.push-1-12.top-notif-bar").remove(),$("#item-holder").length||$(".shop-bar").after('<div class="col-10-12 push-1-12" id="item-holder"></div>'),$(window).unbind("scroll"),$(window).scroll(debouncer(()=>{$(window).scrollTop()+$(window).height()>=$(document).height()-100&&!shopEnd&&r($(".shop-categories .active a").data("itemType"),$("#shopSort :selected").data("sort"),currentSearch,nextCursor)}))),r(l,n,i,"",!0)}}window.loadItems=r,window.toggleFavorite=o,window.searchShop=s}},r=>{var o=e=>r(r.s=e),s=(o(5748),o(9138),o(3880))}]);